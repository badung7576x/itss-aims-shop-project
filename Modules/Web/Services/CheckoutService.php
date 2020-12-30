<?php


namespace Modules\Web\Services;


use App\Repositories\Cart\CartInterface;
use App\Repositories\ShipInfo\ShipInfoInterface;
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
        ShipInfoInterface $shipInfoInterface,
        CartInterface $cartInterface,
        OrderInterface $orderInterface)
    {
        $this->userInterface = $userInterface;
        $this->shipInfoInterface = $shipInfoInterface;
        $this->cartInterface = $cartInterface;
        $this->orderInterface = $orderInterface;
    }
    public function getShipInfo() {
        return $this->shipInfoInterface->getShipInfo();
    }

    public function checkoutCart($request) {
        $user = Auth::user();

        $itemsInCart = $this->cartInterface->getItemsAddByUser($user->id);
        $total = collect($itemsInCart)->sum(function($item){
            return $item->product->price * $item->quantity;
        });
        // Create order
        $orderInfo = [
            'order_no'          => "N" . date('Ymd-His'),
            'user_id'           => $user->id,
            'note'              => $request['note'],
            'shipping_amount'   => 0,
            'order_amount'      => $total,
            'payment_type'      => 1,
            'shipping_type'     => 1,
            'shipping_info_id'  => $request['shipping_info_id'],
            'payment_status'    => 0,
            'order_status'      => ORDER_SUCCESS,
            'ordered_at'        => now()
        ];
        $this->orderInterface->createOrder($orderInfo, $itemsInCart);

        $creditInfo = $request['credit'];
        $paymentService = new PaymentService($creditInfo);
        $result = $paymentService->payment();

        // Clear cart
        $this->cartInterface->clearCart($user->id);
    }

    public function getLatestOrder() {
        $user = Auth::user();
        return $this->orderInterface->getLatestOrder($user->id);
    }

    public function saveShipInfo($data, $id = null) {
        $user = Auth::user();

        $shipInfo = [
            'user_id' => $user->id,
            'receiver_name' => $data['name'],
            'receiver_email' => $data['email'],
            'receiver_phone_number' => $data['phone_number'],
            'province' => $data['province'],
            'address' => $data['address']
        ];

        if(empty($id)) {
            return $this->shipInfoInterface->create($shipInfo);
        }
        return $this->shipInfoInterface->update($id, $shipInfo);
    }
}
