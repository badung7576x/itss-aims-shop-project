<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PromotionDetail extends Model
{
    protected $table = 'promotion_detail';

    protected $fillable = [
        'id', 'promotion_id', 'product_id', 'num_product_discount'
    ];

    public function promotion()
    {
        return $this->belongsTo('App\Entities\Promotion', 'promotion_id');
    }
 
}
