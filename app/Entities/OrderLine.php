<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $table = 'order_lines';

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price', 'promotion_id'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id')->withTrashed();
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('getProduct', function (Builder $builder) {
            $builder->with('product');
        });
    }
}
