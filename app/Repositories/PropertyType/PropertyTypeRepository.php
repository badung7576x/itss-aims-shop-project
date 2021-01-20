<?php


namespace App\Repositories\PropertyType;


use App\Entities\PropertyType;
use App\Repositories\BaseRepository;

class PropertyTypeRepository extends BaseRepository implements PropertyTypeInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return PropertyType::class;
    }

    function getPropertyTypesOfCategory($categoryId)
    {
        return $this->_model->where(['category_id' => $categoryId])->orderBy('sort', 'ASC')->get();
    }

    function getWeightPropertyId() {
        return $this->_model->where(['property_name' => "Khối lượng"])->pluck('id')->toArray();
    }
}

