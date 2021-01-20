<?php


namespace Modules\Web\Services;

use App\Repositories\Cart\CartInterface;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Payment\PaymentInterface;
use App\Repositories\Product\WebProductInterface;
use App\Repositories\ShipInfo\ShipInfoInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{
    protected $userInterface;
    protected $shipInfoInterface;
    protected $cartInterface;
    protected $orderInterface;
    protected $productInterface;
    protected $paymentInterface;

    const SHIPPING_FEE_1 = 22000;       // In the city
    const SHIPPING_FEE_2 = 30000;       // Outside city
    const SHIPPING_FEE_3 = 2500;        // Weight more 3kg

    public function __construct(
        UserInterface $userInterface,
        CartInterface $cartInterface,
        OrderInterface $orderInterface,
        ShipInfoInterface $shipInfoInterface,
        WebProductInterface $productInterface,
        PaymentInterface $paymentInterface
    )
    {
        $this->userInterface = $userInterface;
        $this->cartInterface = $cartInterface;
        $this->orderInterface = $orderInterface;
        $this->shipInfoInterface = $shipInfoInterface;
        $this->productInterface = $productInterface;
        $this->paymentInterface = $paymentInterface;
    }

    public function checkoutCart($request)
    {
        $user = Auth::user();

        $itemsInCart = $this->cartInterface->getItemsAddByUser($user->id);
        $total = $this->_getTotalAmount($itemsInCart);
        $maxWeight = $this->_getMaxWeight($itemsInCart);
        $shipInfo = $this->shipInfoInterface->getShipInfoById($request['shipping_info_id']);
        $shipAmount = $this->_shipAmountCalculate($total, $shipInfo, $maxWeight);

        // Create order
        $orderInfo = [
            'order_no'          => "N" . date('Ymd-His'),
            'user_id'           => $user->id,
            'note'              => $request['note'],
            'shipping_amount'   => $shipAmount,
            'order_amount'      => $total,
            'payment_type'      => 1,
            'shipping_type'     => 1,
            'shipping_info_id'  => $request['shipping_info_id'],
            'payment_status'    => 0,
            'order_status'      => ORDER_WAITING,
            'ordered_at'        => now()
        ];
        $order = $this->orderInterface->createOrder($orderInfo, $itemsInCart);

        $creditInfo = $request['credit'];
        $paymentService = new PaymentService($creditInfo);
        $result = $paymentService->payment($order->order_amount * VAT + $order->shipping_amount);
        if($result['status'] === $paymentService::PAYMENT_SUCCESS) {
            $paymentInfo = [
                'type' => PAYMENT_TYPE['payment'],
                'order_id' => $order->id,
                'tracking_id' => $result['response']->tracking_id,
                'amount' => $order->order_amount * VAT + $order->shipping_amount,
                'paid_at' => date("Y-m-d", strtotime($result['response']->paid_at))
            ];
            $this->paymentInterface->create($paymentInfo);
            $order->payment_status = $result['status'];
            $order->save();
        }

        // Clear cart
        $this->cartInterface->clearCart($user->id);
        return $order;
    }

    public function getLatestOrder()
    {
        $user = Auth::user();
        return $this->orderInterface->getLatestOrder($user->id);
    }

    public function saveShipInfo($data, $id = null) {
        $user = Auth::user();

        $shipInfo = [
            'user_id' => $user->id,
            'receiver_name' => $data['receiver_name'],
            'receiver_email' => $data['receiver_email'],
            'receiver_phone_number' => $data['receiver_phone_number'],
            'province' => $data['province'],
            'address' => $data['address']
        ];

        if(empty($id)) {
            return $this->shipInfoInterface->create($shipInfo);
        }
        return $this->shipInfoInterface->update($id, $shipInfo);
    }

    private function _shipAmountCalculate($total, $shipInfo, $maxWeight) {
        if ($total >= FREESHIP_MINIMUM_AMOUNT) {
            $shipAmount = 0;
        } else if(in_array($shipInfo->province, ["Hà Nội", "Thành phố Hồ Chí Minh"])) {
            $shipAmount = $maxWeight <=3000 ? self::SHIPPING_FEE_1 : self::SHIPPING_FEE_1 + self::SHIPPING_FEE_3 * ($maxWeight - 3000)/500;
        } else {
            $shipAmount = $maxWeight <=3000 ? self::SHIPPING_FEE_2 : self::SHIPPING_FEE_2 + self::SHIPPING_FEE_3 * ($maxWeight - 3000)/500;
        }

        return $shipAmount;
    }

    private function _getTotalAmount($itemsInCart) {
        return collect($itemsInCart)->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    private function _getMaxWeight($itemsInCart) {
        $productIds = collect($itemsInCart)->map(function ($item) {
            return $item->product->id;
        })->toArray();

        $products = $this->productInterface->getProductWithIds($productIds);
        $max = 0;
        foreach($products as $product) {
            $property = collect($product->properties)
                ->where('property_type.property_name', 'Khối lượng')
                ->first();
            $max = max($max, (int) $property->value);
        }
        return $max;
    }
}
