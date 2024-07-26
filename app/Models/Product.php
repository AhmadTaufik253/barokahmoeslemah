<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getImageAttribute()
    {
        return asset('storage/' . $this->photo);
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'categories_id','id');
    }
    public function review()
    {
        return $this->hasMany(OrderRate::class,'product_id','id');
    }
}