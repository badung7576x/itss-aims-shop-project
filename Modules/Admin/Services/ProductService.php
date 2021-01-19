<?php


namespace Modules\Admin\Services;

use App\Entities\PromotionDetail;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Product\AdminProductInterface;
use App\Repositories\Property\PropertyInterface;
use App\Repositories\PropertyType\PropertyTypeInterface;
use App\Repositories\Warehouse\WarehouseInterface;
use App\Repositories\Promotion\PromotionInterface;

use Illuminate\Support\Facades\DB;

class ProductService
{
    protected $productInterface;
    protected $categoryInterface;
    protected $propertyTypeInterface;
    protected $propertyInterface;
    protected $warehouseInterface;
    protected $promotionInterface;

    public function __construct(
        AdminProductInterface $productInterface,
        CategoryInterface $categoryInterface,
        PropertyTypeInterface $propertyTypeInterface,
        PropertyInterface $propertyInterface,
        WarehouseInterface $warehouseInterface,
        PromotionInterface $promotionInterface
        ) {
            $this->productInterface = $productInterface;
            $this->categoryInterface = $categoryInterface;
            $this->propertyTypeInterface = $propertyTypeInterface;
            $this->propertyInterface = $propertyInterface;
            $this->warehouseInterface = $warehouseInterface;
            $this->promotionInterface = $promotionInterface;
    }

    public function getListProducts() {
        return $this->productInterface->getAll();
    }

    public function getCategories() {
        return $this->categoryInterface->getAll();
    }

    public function getPropertyTypeByCategoryId($categoryId) {
        return $this->propertyTypeInterface->getPropertyTypesOfCategory($categoryId);
    }

    public function createProduct(array $data) {
        DB::beginTransaction();
        $productInfo = [
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'value' => $data['value'],
            'price' => $data['price'],
            'status' => $data['status'],
        ];
        $result = $this->productInterface->create($productInfo);
        if(!empty($result)) {
            $this->warehouseInterface->create([
                'product_id' =>  $result->id,
                'quantity' =>  $data['quantity']
            ]);
            foreach($data['properties'] as $key => $value) {
                $propertyInfo = [
                    'product_id' => $result->id,
                    'property_type_id' => $key,
                    'value' => $value,
                ];
                $this->propertyInterface->create($propertyInfo);
            }
            DB::commit();
        } else {
            DB::rollBack();
        }
    }

    public function updateProduct(array $data) {
        DB::beginTransaction();
        $id = $data['id'];
        $productInfo = [
            'title' => $data['title'],
            'image' => $data['image'],
            'value' => $data['value'],
            'price' => $data['price'],
            'status' => $data['status'],
        ];
        $result = $this->productInterface->update($id, $productInfo);
        if(!empty($result)) {
            $this->warehouseInterface->updateOrCreateQuantity($id, $data['quantity']);

            foreach($data['properties'] as $key => $value) {
                $propertyInfo = [
                    'product_id' => $result->id,
                    'property_type_id' => $value['property_type_id'],
                    'value' => $value['value'],
                ];
                $this->propertyInterface->update($key, $propertyInfo);
            }

            DB::commit();
        } else {
            DB::rollBack();
        }
    }

    public function getProductById($id) {
        return $this->productInterface->getProductById($id);
    }

    public function deleteMultiProduct(array $ids) {
        if(count($ids) <= 0) return;
        foreach ($ids as $id) {
            $this->productInterface->deleteProduct($id);
        }
    }

    public function getListPromotions() {
        return $this->promotionInterface->getAll();
    }

    public function createPromotion(array $data) {
        DB::beginTransaction();
        $promotionInfo = [
            'type' => $data['type'],
            'name' => $data['name'],
            'description' => $data['description'],
            'discount' => $data['discount'],
            'num_product_discount' => 0,
            'start_at' => $data['start_at'],
            'end_at' => $data['end_at'],
        ];
        $result = $this->promotionInterface->create($promotionInfo);
        DB::commit();
    }

    public function getPromotion($id) {
        return $this->promotionInterface->getPromotionById($id);
    }

    public function updatePromotion(array $data, $id) {
        return $promotion =  $this->promotionInterface->update($id, $data);
    }

    public function deletePromotion($id)
    {
        $this->promotionInterface->deletePromotion($id);
    }

    public function addProductToPromotion(array $data)
    {
       return PromotionDetail::create($data);
    }
}
