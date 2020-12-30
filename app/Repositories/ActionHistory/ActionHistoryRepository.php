<?php


namespace App\Repositories\ActionHistory;


use App\Repositories\BaseRepository;

class ActionHistoryRepository extends BaseRepository implements ActionHistoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ActionHistoryService::class;
    }
}
