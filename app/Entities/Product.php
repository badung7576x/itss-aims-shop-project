<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'id', 'title', 'category_id', 'image', 'value', 'price', 'status'
    ];

    public function quantity() {
        return $this->hasOne(Warehouse::class, 'product_id', 'id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withTrashed();
    }

    public function properties() {
        return $this->hasMany(Property::class, 'product_id', 'id')->withTrashed();
    }

}
