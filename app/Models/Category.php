<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'titles', 'slug', 'photo',
    ];
    public function getImageAttribute()
    {
        return asset('storage/' . $this->photo);
    }
}
