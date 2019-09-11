<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Out_record extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
}
