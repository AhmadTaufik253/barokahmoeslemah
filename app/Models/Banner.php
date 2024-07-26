<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function getImageAttribute()
    {
        return asset('storage/' . $this->photo);
    }
}
