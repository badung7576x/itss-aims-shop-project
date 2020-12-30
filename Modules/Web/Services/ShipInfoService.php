<?php

namespace Modules\Web\Services;


use App\Repositories\ShipInfo\ShipInfoInterface;

class ShipInfoService
{
    protected $shipInfoInterface;

    public function __construct(ShipInfoInterface $shipInfoInterface)
    {
        $this->shipInfoInterface = $shipInfoInterface;
    }

    public function getShipInfo()
    {
        return $this->shipInfoInterface->getShipInfo();
    }
}


