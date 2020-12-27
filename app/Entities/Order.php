<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_no', 'user_id', 'note', 'shipping_amount', 'order_amount', 'payment_type', 'shipping_type', 'payment_status', 'order_status', 'ordered_at'
    ];

    public function order_items() {
        return $this->hasMany(OrderLine::class, 'order_id', 'id');
    }

}
