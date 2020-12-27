<?php


namespace Modules\Web\Services;


use App\Repositories\Cart\CartInterface;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Warehouse\WarehouseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    protected $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }

    public function getUserOrders() {
        $user = Auth::user();
        return $this->orderInterface->getUserOrders($user->id);
    }

}
