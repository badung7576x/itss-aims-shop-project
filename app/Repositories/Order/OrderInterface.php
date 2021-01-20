<?php


namespace App\Repositories\Order;


interface OrderInterface
{
    public function createOrder(array $attributes, $items);

    public function getLatestOrder($userId);

    public function getUserOrders($userId);

    public function getOrderById($id);

    public function find($id);
}
