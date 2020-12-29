<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Web\Services\CartService;
use Modules\Web\Services\OrderService;
use Modules\Web\Services\ShipInfoService;

class AccountController extends WebBaseController
{
    protected $orderService;
    protected $shipInfoService;

    public function __construct(OrderService $orderService, ShipInfoService $shipInfoService)
    {
        $this->orderService = $orderService;
        $this->shipInfoService = $shipInfoService;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $orders = $this->orderService->getUserOrders();

        return view('web::account.order', compact('user', 'orders'));
    }

    public function orderDetail($id) {
        $order = $this->orderService->getOrderById($id);
        $user = Auth::guard('web')->user();
        $shipInfo = $this->shipInfoService->getShipInfo();

        return view('web::account.order-detail', compact('user', 'order', 'shipInfo'));
    }
}
