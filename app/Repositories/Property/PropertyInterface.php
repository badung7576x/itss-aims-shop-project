<?php


namespace App\Repositories\Property;


interface PropertyInterface
{
    function create(array $data);

    function update($id, array $data);

    public function getWeightProperty($productIdArr, $propertyTypeIdArr);
}
