<?php


namespace App\Repositories\ShipInfo;

use App\Entities\ShipInfo;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class ShipInfoRepository extends BaseRepository implements ShipInfoInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ShipInfo::class;
    }


    public function getShipInfo()
    {
        $userId = Auth::user()->id;
        return $this->_model->where('user_id', $userId)->latest()->first();
    }

}

