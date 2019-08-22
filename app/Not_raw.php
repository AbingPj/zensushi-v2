<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Not_raw extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
}
