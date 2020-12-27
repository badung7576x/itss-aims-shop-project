<?php


namespace App\Repositories\ShipInfo;


interface ShipInfoInterface
{
    public function create(array $attributes);

    public function getShipInfo();
}
