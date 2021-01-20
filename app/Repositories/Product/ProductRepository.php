<?php


namespace App\Repositories\Product;


use App\Entities\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements AdminProductInterface, WebProductInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Product::class;
    }

    public function getAll()
    {
        return $this->_model->with(['quantity', 'category'])->get();
    }

    public function getAllWithPaginate()
    {
        return $this->_model->whereStatus(1)->with(['category'])->paginate(PER_PAGE);
    }

    public function getProductById($id)
    {
        return $this->_model->with(['category', 'properties', 'quantity'])->find($id);
    }

    function getListProductsWithKeyword($keyword, $categoryId = null)
    {
        $query = $this->_model->whereStatus(1);
        if($categoryId) $query = $query->where('category_id', $categoryId);
        $query = $query->where('title', 'like', "%".$keyword."%");

        return $query->with(['category'])->paginate(PER_PAGE);
    }

    public function deleteProduct($id)
    {
        $product = $this->find($id);
        $product->properties()->delete();
        $product->quantity()->delete();
        $product->delete();
    }

    public function getProductWithIds(array $ids) {
        return $this->_model->with('properties')->whereIn('id', $ids)->get();
    }
}

