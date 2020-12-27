<?php


namespace Modules\Web\Services;


use App\Repositories\Category\CategoryInterface;
use App\Repositories\Product\WebProductInterface;
use App\Repositories\Promotion\PromotionInterface;
use App\Repositories\Warehouse\WarehouseInterface;
use Illuminate\Http\Request;

class ProductService
{
    protected $productInterface;
    protected $categoryInterface;
    protected $warehouseInterface;
    protected $promotionInterface;
    public function __construct(
        WebProductInterface $productInterface,
        CategoryInterface $categoryInterface,
        WarehouseInterface $warehouseInterface,
        PromotionInterface $promotionInterface) {
        $this->productInterface = $productInterface;
        $this->categoryInterface = $categoryInterface;
        $this->warehouseInterface = $warehouseInterface;
        $this->promotionInterface = $promotionInterface;
    }

    public function getListProducts() {
        return $this->productInterface->getAllWithPaginate();
    }

    public function getCategories() {
        return $this->categoryInterface->getAll();
    }

    public function getProductDetail($id) {
        return $this->productInterface->getProductById($id);
    }

    public function checkProductQuantity($productId, $quantity) {
        $remainQuantity = $this->warehouseInterface->getQuantityRemaining($productId);
        return $remainQuantity >= $quantity;
    }

    public function getListProductByKeyword(Request $request) {
        $categoryId = $request->get('category_id');
        $keyword = $request->get('keyword');
        $products = null;
        if(empty($categoryId)) {
            $products =  $this->productInterface->getListProductsWithKeyword($keyword);
        } else {
            $products = $this->productInterface->getListProductsWithKeyword($keyword, $categoryId);
        }
        return $products;
    }

    public function getAllPromotions() {
        return $this->promotionInterface->getAll();
    }

}
