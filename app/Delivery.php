<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $guarded = [];

    public function delivery_lists()
    {
        return $this->hasMany(Delivery_list::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
