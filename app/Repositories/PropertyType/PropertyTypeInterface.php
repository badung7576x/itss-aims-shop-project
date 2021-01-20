<?php


namespace App\Repositories\PropertyType;


interface PropertyTypeInterface
{
    function getPropertyTypesOfCategory($categoryId);

    function getWeightPropertyId();
}
