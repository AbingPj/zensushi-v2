<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class In_record extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
}
