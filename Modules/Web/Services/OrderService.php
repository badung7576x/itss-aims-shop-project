<?php


namespace Modules\Web\Services;


use App\Repositories\Order\OrderInterface;
use App\Repositories\Payment\PaymentInterface;
use App\Repositories\Warehouse\WarehouseInterface;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    protected $orderInterface;
    protected $warehouseInterface;
    protected $paymentInterface;

    public function __construct(OrderInterface $orderInterface,
                                WarehouseInterface $warehouseInterface,
                                PaymentInterface $paymentInterface)
    {
        $this->orderInterface = $orderInterface;
        $this->warehouseInterface = $warehouseInterface;
        $this->paymentInterface = $paymentInterface;
    }

    public function getUserOrders()
    {
        $user = Auth::user();
        return $this->orderInterface->getUserOrders($user->id);
    }

    public function getOrderById($id)
    {
        return $this->orderInterface->getOrderById($id);
    }

    public function cancelOrder($orderId) {
        $order = $this->orderInterface->getOrderById($orderId);
        $paymentService = new PaymentService();
        $result = $paymentService->cancel($order);
        if($result['status'] === $paymentService::CANCEL_SUCCESS) {
            $paymentInfo = [
                'type' => PAYMENT_TYPE['refund'],
                'order_id' => $order->id,
                'tracking_id' => $result['response']->tracking_id,
                'amount' => $order->order_amount * VAT + $order->shipping_amount,
                'paid_at' => date("Y-m-d", strtotime($result['response']->cancel_at))
            ];
            $this->paymentInterface->create($paymentInfo);
            collect($order->order_items)->each(function ($item) {
                $this->warehouseInterface->backProductQuantity($item->product_id, $item->quantity);
            });
            $order->order_status = ORDER_FAILURE;
            $order->save();
            return true;
        } else {
            return false;
        }
    }

}
