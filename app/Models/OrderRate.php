<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderRate extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
