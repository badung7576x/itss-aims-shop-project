<?php


namespace App\Repositories\Order;

use App\Entities\Order;
use App\Entities\OrderLine;
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
            $orderItems = [];
            foreach($items as $item) {
                $orderItems[] = [
                    'order_id' => $order['id'],
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'promotion_id' => null
                ];
            }
            OrderLine::insert($orderItems);
            DB::commit();
        } else {
            DB::rollBack();
        }


    }

    public function getLatestOrder($userId)
    {
        return $this->_model->where('user_id', $userId)->with('order_items')->latest()->first();
    }

    public function getOrderById($id)
    {
        return $this->find($id);
    }

    public function getUserOrders($userId)
    {
        return $this->_model->where('user_id', $userId)->get();
    }
}

