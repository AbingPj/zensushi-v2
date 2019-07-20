<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded=[];

    public function items()
    {
        return $this->hasMany('App\Item', 'unit_id', 'id');
    }
}