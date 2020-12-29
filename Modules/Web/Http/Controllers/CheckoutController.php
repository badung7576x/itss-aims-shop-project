<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Web\Services\CartService;
use Modules\Web\Services\CheckoutService;
use Modules\Web\Services\ProductService;
use Modules\Web\Services\ShipInfoService;

class CheckoutController extends WebBaseController
{
    protected $productService;
    protected $checkoutService;
    protected $shipInfoService;

    public function __construct(ProductService $productService, CartService $cartService,
                                CheckoutService $checkoutService, ShipInfoService $shipInfoService)
    {
        parent::__construct($cartService);
        $this->productService = $productService;
        $this->checkoutService = $checkoutService;
        $this->shipInfoService = $shipInfoService;
    }

    public function checkout() {
        $messages = [];
        $canCheckout = $this->cartService->checkQuantityInCart($messages);
        if(!$canCheckout) {
            return redirect()->back()->with(['message' => $messages]);
        }

        $itemsInCart = $this->cartService->getItemsAddByUser($this->user->id);
        $totalAmount = $this->cartService->getTotalAmountInCart($itemsInCart);
        $shipInfo = $this->checkoutService->getShipInfo();

        return view('web::checkout.index', compact('itemsInCart', 'totalAmount', 'shipInfo'));
    }

    public function postCheckout(Request $request) {
        $shipInfoType = $request->get('type');
        if ($shipInfoType == 1) {
            // Add ship infor to db
        } else {
            // Update ship info
        }
        // Validate va thanh toan
        $result = $this->checkoutService->checkoutCart($request->all());
        return redirect()->route('web.checkout.success');
    }

    public function checkoutSuccess() {
        $order = $this->checkoutService->getLatestOrder();
        $user = Auth::guard('web')->user();
        $shipInfo = $this->shipInfoService->getShipInfo();
//        dd($order);
        return view('web::checkout.success', compact('order', 'user', 'shipInfo'));
    }
}
