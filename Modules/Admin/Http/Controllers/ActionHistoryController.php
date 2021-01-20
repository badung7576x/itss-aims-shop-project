<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Services\ActionHistoryService;

class ActionHistoryController extends Controller
{
    protected $historyService;
    public function __construct(ActionHistoryService $actionHistoryService)
    {
        $this->historyService = $actionHistoryService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $histories = $this->historyService->getAllHistory();
//        dd($histories);
        return view('admin::histories.index', compact('histories'));
    }
}
