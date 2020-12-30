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
            return redirect()->back()->with(['status' => false, 'message' => $messages]);
        }

        $itemsInCart = $this->cartService->getItemsAddByUser($this->user->id);
        if(count($itemsInCart) <= 0) {
            return redirect()->back()->with(['status' => false, 'message' => "Giỏ hàng trống! Không thể đặt hàng"]);
        }

        $totalAmount = $this->cartService->getTotalAmountInCart($itemsInCart);
        $shipInfo = $this->checkoutService->getShipInfo();

        return view('web::checkout.index', compact('itemsInCart', 'totalAmount', 'shipInfo'));
    }

    public function postCheckout(Request $request) {
        $shipInfoType = $request->get('type');
        $shipInfoData = $request->only(['name', 'email', 'phone_number', 'province', 'address']);

        if ($shipInfoType == 1) {
            $shipInfo = $this->checkoutService->saveShipInfo($shipInfoData);
        } else {
            $shipInfo = $this->checkoutService->saveShipInfo($shipInfoData, $request->get('id'));
        }
        $request->request->add(['shipping_info_id' => $shipInfo->id]);

        $this->checkoutService->checkoutCart($request->all());
        return redirect()->route('web.checkout.success');
    }

    public function checkoutSuccess() {
        $order = $this->checkoutService->getLatestOrder();
        $user = Auth::guard('web')->user();
        $shipInfo = $this->shipInfoService->getShipInfo();
        return view('web::checkout.success', compact('order', 'user', 'shipInfo'));
    }
}
