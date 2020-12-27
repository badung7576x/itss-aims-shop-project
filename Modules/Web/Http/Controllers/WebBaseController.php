<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Web\Services\CartService;

class WebBaseController extends Controller
{
    public $cartService;
    public $user;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            if(!empty($this->user)){
                View::share('user', $this->user);
                $quantityInCart = $this->cartService->getQuantityInCart($this->user->id);
                View::share('quantityInCart', $quantityInCart);
            }
            return $next($request);
        });

    }
}
