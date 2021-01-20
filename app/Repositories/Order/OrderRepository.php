<?php


namespace App\Repositories\Order;

use App\Entities\Order;
use App\Entities\OrderLine;
use App\Entities\PromotionDetail;
use App\Entities\Warehouse;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements OrderInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Order::class;
    }

    public function createOrder(array $order, $items)
    {
        DB::beginTransaction();
        $order = $this->_model->create($order);
        if(!empty($order)) {
            foreach($items as $item) {
                if ($item->promotion_price == 0) {
                    $orderItem = [
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                        'promotion_price' => 0 
                    ];
                } else {
                    $orderItem = [
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                        'promotion_price' => $item->promotion_price
                    ];
                    $promotionDetail = PromotionDetail::where('product_id' ,$item->product_id)->first();
                    $numSold = $promotionDetail->num_product_sell ?? 0;
                    $promotionDetail->update([
                        'num_product_sell' => $numSold +  $item->quantity,
                    ]);
                }
                OrderLine::create($orderItem);
                Warehouse::where('product_id', $item->product_id)->decrement('quantity', $item->quantity);
            }
            DB::commit();
        } else {
            DB::rollBack();
        }

        return $order;
    }

    public function getLatestOrder($userId)
    {
        return $this->_model->where('user_id', $userId)->with('order_items')->latest()->first();
    }

    public function getOrderById($id)
    {
        return $this->_model->with('order_items')->find($id);
    }

    public function getUserOrders($userId)
    {
        return $this->_model->where('user_id', $userId)->latest('updated_at')->get();
    }
}

