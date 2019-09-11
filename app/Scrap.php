<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scrap extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
}
