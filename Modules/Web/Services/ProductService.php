<?php


namespace Modules\Web\Services;


use App\Repositories\Cart\CartInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Product\WebProductInterface;
use App\Repositories\Promotion\PromotionInterface;
use App\Repositories\Warehouse\WarehouseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    protected $productInterface;
    protected $categoryInterface;
    protected $warehouseInterface;
    protected $promotionInterface;
    protected $cartInterface;

    public function __construct(
        WebProductInterface $productInterface,
        CategoryInterface $categoryInterface,
        WarehouseInterface $warehouseInterface,
        PromotionInterface $promotionInterface,
        CartInterface $cartInterface) {

        $this->productInterface = $productInterface;
        $this->categoryInterface = $categoryInterface;
        $this->warehouseInterface = $warehouseInterface;
        $this->promotionInterface = $promotionInterface;
        $this->cartInterface = $cartInterface;
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
        $user = Auth::user();
        $remainQuantity = $this->warehouseInterface->getQuantityRemaining($productId);
        $quantityInCart = $this->cartInterface->getQuantityProductInCart($user->id, $productId);
        return $remainQuantity - $quantityInCart >= $quantity;
    }

    public function getListProductByKeyword($categoryId, $keyword) {
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
