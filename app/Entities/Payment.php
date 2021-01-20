<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'type', 'order_id', 'tracking_id', 'amount', 'paid_at'
    ];
}
