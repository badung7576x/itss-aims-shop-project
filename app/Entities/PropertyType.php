<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyType extends Model
{
    use SoftDeletes;

    protected $table = 'property_types';

    protected $fillable = [
        'category_id', 'property_name', 'filterable', 'sort'
    ];
}
