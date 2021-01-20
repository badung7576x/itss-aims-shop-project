<?php


namespace App\Repositories\Product;


interface WebProductInterface
{
    function getAllWithPaginate();

    function getProductById($id);

    function getListProductsWithKeyword($keyword, $categoryId = null);

    function getProductWithIds(array $ids);
}
