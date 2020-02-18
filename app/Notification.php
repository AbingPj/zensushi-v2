<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
   
    public function scopeCountUnseen($query)
    {
        return $query->where('seen', 0)->count();
    }
}
