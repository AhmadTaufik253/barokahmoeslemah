<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }
    public function order_rates()
    {
        return $this->hasMany(OrderRate::class,'order_id','id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class,'province_id','province_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city_id','city_id');
    }
    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class,'subdistrict_id','subdistrict_id');
    }
}
