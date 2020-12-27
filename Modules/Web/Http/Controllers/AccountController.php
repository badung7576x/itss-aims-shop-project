<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Web\Services\CartService;
use Modules\Web\Services\OrderService;

class AccountController extends WebBaseController
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
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
}
