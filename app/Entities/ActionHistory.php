<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ActionHistory extends Model
{
    protected $table = 'action_histories';

    protected $fillable = [
        'user_id', 'action_type', 'descriptions', 'activated_at'
    ];
}
