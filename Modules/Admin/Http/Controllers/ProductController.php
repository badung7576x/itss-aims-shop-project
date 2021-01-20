<?php

namespace Modules\Admin\Http\Controllers;

use App\Entities\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\ProductCRUDRequest;
use Modules\Admin\Services\ActionHistoryService;
use Modules\Admin\Http\Requests\PromotionRequest;
use Modules\Admin\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;
    protected ActionHistoryService $historyService;

    public function __construct(ProductService $productService, ActionHistoryService $historyService)
    {
        $this->productService = $productService;
        $this->historyService = $historyService;
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

    public function create(Request $request) {
        $product = $this->productService->createProduct($request->all());
        $this->historyService->addProductHistory($product);
        return redirect()->route('admin.product.list')->with(['type' => 'success', 'message' => "Thêm sản phẩm thành công!"]);;
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
        if(!$this->historyService->checkHistory('edit_product')) {
            return back()->with(['type' => 'error', 'message' => "Thao tác vượt quá giới hạn cho phép trong ngày!"]);;
        }
        $product = $this->productService->updateProduct($request->all());
        $this->historyService->editProductHistory($product);
        return redirect()->route('admin.product.list')->with(['type' => 'success', 'message' => "Cập nhật sản phẩm thành công!"]);
    }

    public function delete(Request $request) {
        $ids = $request->get('ids');
        if(empty($ids)) return back()->with(['type' => 'error', 'message' => "Bạn chưa lựa chọn sản phẩm!"]);
        if(count($ids) >= 10) return back()->with(['type' => 'error', 'message' => "Số lượng vượt quá giới hạn cho phép trong một lần xóa!"]);
        if(!$this->historyService->checkHistory('delete_product')) {
            return back()->with(['type' => 'error', 'message' => "Thao tác vượt quá giới hạn cho phép trong ngày!"]);
        }
        $this->productService->deleteMultiProduct($ids);
        $this->historyService->deleteProductsHistory($ids);

        return redirect()->route('admin.product.list')->with(['type' => 'success', 'message' => "Xóa sản phẩm thành công!"]);
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
        $product = Product::findOrFail($data['product_id'])->update([
            'status' => 3,
        ]);
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
