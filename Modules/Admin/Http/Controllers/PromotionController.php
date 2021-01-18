<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Services\ProductService;

class PromotionController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
        $promotions = $this->productService->getListPromotions();
        return view('admin::promotion.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $promotions = $this->productService->createPromotion($data);
        return redirect()->route('promotion.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $promotion =  $this->productService->getPromotion($id);
        return view('admin::promotion.detail',compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $promotion =  $this->productService->getPromotion($id);
        return view('admin::promotion.edit',compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $promotion =  $this->productService->updatePromotion($data,$id);
        return redirect()->route('promotion.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->productService->deletePromotion($id);
        return redirect()->route('promotion.index');
    }
}
