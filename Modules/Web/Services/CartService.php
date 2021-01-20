<?php


namespace Modules\Web\Services;


use App\Repositories\Cart\CartInterface;
use App\Repositories\Warehouse\WarehouseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartService
{
    protected $cartInterface;
    protected $warehouseInterface;
    protected $productService;

    public function __construct(
        CartInterface $cartInterface,
        WarehouseInterface $warehouseInterface,
        ProductService $productService)
    {
        $this->warehouseInterface = $warehouseInterface;
        $this->cartInterface = $cartInterface;
        $this->productService = $productService;
    }

    public function getQuantityInCart($userId) {
        return $this->cartInterface->getQuantityInCart($userId);
    }

    public function addCart(Request $request, $userId) {
        $where = [
            'user_id' => $userId,
            'product_id' => $request->get('product_id'),
        ];
        $itemInCart = $this->cartInterface->getItemByConditions($where);
        if(empty($itemInCart)) {
            $cartInfo = [
                'quantity' => $request->get('quantity'),
                'promotion_price' => $request->get('promotion_price')
            ];
            $cartInfo = array_merge($cartInfo, $where);
            $this->cartInterface->create($cartInfo);
        } else {
            $itemInCart->increment('quantity', $request->quantity);
        }
    }

    public function getItemsAddByUser($userId) {
        return $this->cartInterface->getItemsAddByUser($userId);
    }

    public function removeItemInCart(Request $request, $user) {
        $whereCondition = [
            'product_id' => $request->get('product_id'),
            'user_id' => $user->id
        ];
        return $this->cartInterface->removeItem($whereCondition);
    }

    public function updateCart($userId, $data) {
        $whereCondition = [
            'product_id' => $data->product_id,
            'user_id' => $userId
        ];
        $updateData = [
            'quantity' => $data->quantity
        ];
        $this->cartInterface->updateItem($whereCondition, $updateData);
    }

    public function checkQuantityInCart(array &$messages, array $items = null) {
        $user = Auth::guard('web')->user();
        $itemsInCart = $items ?? $this->cartInterface->getItemsAddByUser($user->id);
        foreach ($itemsInCart as $item) {
            $result = $this->productService->checkProductQuantity($item->product_id, $item->quantity);
            if(!$result) {
                $error['id'] = $item->product_id;
                $error['message'] = "Số lượng của sản phẩm " . $item->product->title . " hiện tại không đủ. Bạn vui lòng đặt hàng sau!";
                $messages[] = $error;
            }
        }

        return count($messages) <= 0;
    }

    public function getTotalAmountInCart($itemsInCart) {
        return collect($itemsInCart)->sum(function($item){
            if ($item->promotion_price == 0) {
                return $item->product->price * $item->quantity;
            } else {
                return $item->promotion_price * $item->quantity;
            }
        });
    }

}
