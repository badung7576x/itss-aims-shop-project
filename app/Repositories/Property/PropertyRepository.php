<?php


namespace App\Repositories\Property;


use App\Entities\Property;
use App\Repositories\BaseRepository;

class PropertyRepository extends BaseRepository implements PropertyInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Property::class;
    }

    public function getWeightProperty($productIdArr, $propertyTypeIdArr) {
        $whereConditions = [];

    }

}

