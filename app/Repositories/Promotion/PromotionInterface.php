<?php


namespace App\Repositories\Promotion;


interface PromotionInterface
{
    function getAll();

    function create(array $data);

    function update($id, array $data);

    function getPromotionById($id);

    function deletePromotion($id);
}
