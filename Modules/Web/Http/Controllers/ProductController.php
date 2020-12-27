<?php

namespace Modules\Web\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Web\Services\CartService;
use Modules\Web\Services\ProductService;

class ProductController extends WebBaseController
{
    protected $productService;

    public function __construct(ProductService $productService, CartService $cartService)
    {
        parent::__construct($cartService);
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $products = $this->productService->getListProducts();
        $categories = $this->productService->getCategories();
        return view('web::home.index', compact('products', 'categories'));
    }

    public function showDetail(Request $request, int $id){
        $product = $this->productService->getProductDetail($id);
        $categories = $this->productService->getCategories();
        return view('web::detail.index', compact('categories', 'product'));
    }

    public function search(Request $request) {
        $categoryId = $request->get('category_id');
        $keyword = $request->get('keyword');
        $categories = $this->productService->getCategories();
        $products = $this->productService->getListProductByKeyword($categoryId, $keyword);
        return view('web::home.index', compact('products', 'categories', 'categoryId', 'keyword'));
    }
}

