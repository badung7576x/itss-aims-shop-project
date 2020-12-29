<?php


namespace Modules\Web\Services;


use App\Repositories\Cart\CartInterface;
use App\Repositories\Order\OrderInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{
    protected $userInterface;
    protected $shipInfoInterface;
    protected $cartInterface;
    protected $orderInterface;

    public function __construct(
        UserInterface $userInterface,
        CartInterface $cartInterface,
        OrderInterface $orderInterface)
    {
        $this->userInterface = $userInterface;
        $this->cartInterface = $cartInterface;
        $this->orderInterface = $orderInterface;
    }

    public function checkoutCart($request)
    {
        $user = Auth::user();
        $creditInfo = $request['credit'];
        $paymentService = new PaymentService($creditInfo);
        $result = $paymentService->payment();
        if (!$result['status'] === PaymentService::PAYMENT_SUCCESS) {
            return false;
        }

        $itemsInCart = $this->cartInterface->getItemsAddByUser($user->id);
        $total = collect($itemsInCart)->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        // Create order
        $orderInfo = [
            'order_no' => "N" . date('Ymd-Hmi'),
            'user_id' => $user->id,
            'note' => $request['note'],
            'shipping_amount' => 0,
            'order_amount' => $total,
            'payment_type' => 1,
            'shipping_type' => 1,
            'payment_status' => $result['status'],
            'order_status' => ORDER_SUCCESS,
            'ordered_at' => now()
        ];
        $this->orderInterface->createOrder($orderInfo, $itemsInCart);
        // Clear cart
        $this->cartInterface->clearCart($user->id);
    }

    public function getLatestOrder()
    {
        $user = Auth::user();
        return $this->orderInterface->getLatestOrder($user->id);
    }
}
