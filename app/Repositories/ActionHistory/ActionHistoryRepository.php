<?php


namespace App\Repositories\ActionHistory;


use App\Entities\ActionHistory;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class ActionHistoryRepository extends BaseRepository implements ActionHistoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ActionHistory::class;
    }

    public function countHistories($type)
    {
        return $this->_model->whereDate('activated_at', Carbon::today())->whereActionType($type)->count();
    }

    public function getAllHistories()
    {
        $histories = $this->_model->orderBy('activated_at', 'DESC')->limit(120)->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->activated_at)->format('Y-m-d');
            });
        return $histories;
    }
}
