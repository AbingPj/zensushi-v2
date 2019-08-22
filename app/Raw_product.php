<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raw_product extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }

    public function raw()
    {
        return $this->belongsTo('App\Raw', 'raw_id', 'id');
    }
}
