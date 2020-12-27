<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ShipInfo extends Model
{
    protected $table = 'shipping_infos';

    protected $fillable = [
        'id', 'user_id', 'receiver_name', 'receiver_email', 'receiver_phone_number', 'province', 'address'
    ];
}
