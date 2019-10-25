<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raw extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }

    public function raw_products()
    {
        return $this->hasMany('App\Raw_product', 'raw_id', 'id');
    }
}
