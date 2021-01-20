<?php


namespace App\Repositories\ShipInfo;


interface ShipInfoInterface
{
    public function create(array $attributes);

    public function getShipInfo();

    public function update($id, array $attributes);

    public function getShipInfoById($id);
}
