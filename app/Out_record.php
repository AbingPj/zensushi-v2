<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Out_record extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
    
    public function scrap()
    {
        return $this->hasOne('App\Scrap', 'raw_out_id', 'id');
    }

    public function bone()
    {
        return $this->hasOne('App\Bone', 'raw_out_id', 'id');
    }
    
}
