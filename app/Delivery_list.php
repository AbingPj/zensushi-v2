<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_list extends Model
{
    protected $guarded = [];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
