<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\ProductCRUDRequest;
use Modules\Admin\Http\Requests\PromotionRequest;
use Modules\Admin\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $products = $this->productService->getListProducts();
        $categories = $this->productService->getCategories();

        return view('admin::products.index', compact('products', 'categories'));
    }

    public function showCreateForm(Request $request) {
        $categories = $this->productService->getCategories();
        return view('admin::products.create', compact('categories'));
    }

    public function create(ProductCRUDRequest $request) {
        $this->productService->createProduct($request->all());
        return redirect()->route('admin.product.list');
    }

    public function renderPropertyForm(Request $request) {
        if($request->ajax()) {
            $categoryId = $request->get('category_id');
            $oldDatas = $request->get('old_data');
            $propertyTypes = $this->productService->getPropertyTypeByCategoryId($categoryId);
            $propertyForm = view('admin::products.property-form', compact('propertyTypes', 'oldDatas'))->render();
            return response()->json(compact('propertyForm'));
        } else {
            return response()->json([]);
        }
    }

    public function showEditForm(Request $request, $id) {
        $product = $this->productService->getProductById($id);

        return view('admin::products.edit', compact('product'));
    }

    public function edit(ProductCRUDRequest $request) {
        $this->productService->updateProduct($request->all());
        return redirect()->route('admin.product.list');
    }

    public function delete(Request $request) {
        $ids = $request->get('ids');
        if(empty($ids)) return back();
        $this->productService->deleteMultiProduct($ids);

        return redirect()->route('admin.product.list');
    }

    public function showChoosePromotion($productId)
    {
        $product = $this->productService->getProductById($productId);
        $promotions = $this->productService->getListPromotions();
        return view('admin::products.choose-promotion', compact('product', 'promotions','productId'));
    }

    public function addProductToPromotion(PromotionRequest $request)
    {
        $id = $request->get('promotion_id');
        $promotionTarget = $this->productService->getPromotion($id);
        $data = $request->all();
        $promotionDetail = $this->productService->addProductToPromotion($data);
        if ($data['num_product_discount'] != 0)
        {
            $data['num_product_discount'] += $promotionTarget->num_product_discount;
        }
        unset($data['product_id']);
        $promotion =  $this->productService->updatePromotion($data,$id);
        return redirect()->route('promotion.index');
    }

    public function updateChoosePromotion(PromotionRequest $request)
    {
        $id = $request->get('promotion_id');
        $data = $request->all();
        $promotion =  $this->productService->updatePromotion($data,$id);
        return redirect()->route('promotion.index');
    }
    
    public function detail(Request $request, $id) {
        $product = $this->productService->getProductById($id);

        return view('admin::products.detail', compact('product'));
    }
}
