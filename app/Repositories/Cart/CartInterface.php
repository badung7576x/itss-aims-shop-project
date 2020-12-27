<?php


namespace App\Repositories\Cart;


interface CartInterface
{
    function create(array $data);

    function getQuantityInCart($userId);

    function getItemByConditions(array $conditions);

    function getItemsAddByUser($userId);

    function removeItem(array $conditions);

    function updateItem(array $conditions, array $data);

    function getQuantityProductInCart($userId, $productId);

    function clearCart($userId);
}
