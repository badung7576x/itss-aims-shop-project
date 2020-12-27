<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Web\Services\CartService;
use Modules\Web\Services\ProductService;

class CartController extends WebBaseController
{
    protected $productService;
    public function __construct(ProductService $productService, CartService $cartService)
    {
        parent::__construct($cartService);
        $this->productService = $productService;
    }

    public function showCart() {
        if(empty($this->user)) {
            return redirect()->route('home');
        }
        $itemsInCart = $this->cartService->getItemsAddByUser($this->user->id);
        $totalAmount = $this->cartService->getTotalAmountInCart($itemsInCart);

        return view('web::cart.index', compact('itemsInCart', 'totalAmount'));
    }

    public function updateCart(Request $request) {
        $items = $request->get('items');
        $messages = [];
        foreach ($items as $item) {
            $item = (object) $item;
            $result = $this->productService->checkProductQuantity($item->product_id, $item->quantity);
            if(!$result) {
                $error['id'] = $item->product_id;
                $error['message'] = "Số lượng của sản phẩm " . $item->title . " hiện tại không đủ. Bạn vui lòng đặt hàng sau!";
                $messages[] = $error;
            } else {
                $this->cartService->updateCart($this->user->id, $item);
            }
        }
        if (empty($messages)) return response()->json(['status' => true, 'message' => "Cập nhật giỏ hàng thành công!"]);
        return response()->json(['status' => false, 'message' => $messages]);
    }

    public function removeItemInCart(Request $request) {
        $result = $this->cartService->removeItemInCart($request, $this->user);
        if($result) {
            $quantityInCart = $this->cartService->getQuantityInCart($this->user->id);
            $cartItem = view('web::layouts.cart-item', compact('quantityInCart'))->render();
            return response()->json(['status' => true, 'cartItem' => $cartItem]);
        }
        return response()->json(['status' => false, 'message' => "Không thể xóa sản phẩm khỏi giỏ hàng!"]);
    }

    public function addProductToCart(Request $request) {
        $user = Auth::guard('web')->user();
        if(empty($user)) {
            return response()->json(['status' => false, 'message' => "Bạn cần đăng nhập để có thể thêm vào giỏ hàng!"]);
        }
        $result = $this->productService->checkProductQuantity($request->get('product_id'), $request->get('quantity'));
        if(!$result) {
            return response()->json(['status' => false, 'message' => "Số lượng của sản phẩm hiện tại không đủ. Bạn vui lòng đặt hàng sau!"]);
        }
        $this->cartService->addCart($request, $user->id);
        $quantityInCart = $this->cartService->getQuantityInCart($user->id);
        $cartItem = view('web::layouts.cart-item', compact('quantityInCart'))->render();
        return response()->json(['status' => true, 'cartItem' => $cartItem]);

    }
}
