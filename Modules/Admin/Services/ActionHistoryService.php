<?php


namespace Modules\Admin\Services;


use App\Repositories\ActionHistory\ActionHistoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ActionHistoryService
{
    const MAX_EDIT_TIMES = 10;
    const MAX_DELETE_TIMES = 10;
    private $actionHistoryInterface;
    public function __construct(ActionHistoryInterface $actionHistoryInterface)
    {
        $this->actionHistoryInterface = $actionHistoryInterface;
    }

    public function addProductHistory($product) {
        $admin = Auth::guard('admin')->user();
        $message = "Thêm sản phẩm '" . $product->title . "' vào hệ thống";
        $history = [
            'user_id' => $admin->id,
            'action_type' => "create_product",
            'descriptions' => $message,
            'activated_at' => Carbon::now()
        ];
        $this->actionHistoryInterface->create($history);
    }

    public function editProductHistory($product) {
        $admin = Auth::guard('admin')->user();
        $message = "Cập nhật thông tin sản phẩm " . $product->title;
        $history = [
            'user_id' => $admin->id,
            'action_type' => "edit_product",
            'descriptions' => $message,
            'activated_at' => Carbon::now()
        ];
        $this->actionHistoryInterface->create($history);
    }

    public function deleteProductsHistory($ids) {
        $admin = Auth::guard('admin')->user();
        foreach($ids as $id) {
            $message = "Xóa sản phẩm có id: " . $id . " khỏi hệ thống";
            $history = [
                'user_id' => $admin->id,
                'action_type' => "delete_product",
                'descriptions' => $message,
                'activated_at' => Carbon::now()
            ];
            $this->actionHistoryInterface->create($history);
        }
    }

    public function checkHistory($type) {
        $times = $this->_countHistoryInDay($type);
        if($type == 'edit_product' && $times > self::MAX_EDIT_TIMES) return false;
        else if($type == 'delete_product' && $times > self::MAX_DELETE_TIMES) return false;
        return true;
    }

    private function _countHistoryInDay($type) {
        return $this->actionHistoryInterface->countHistories($type);
    }

    public function getAllHistory() {
        return $this->actionHistoryInterface->getAllHistories();
    }


}
