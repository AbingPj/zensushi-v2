<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_type extends Model
{
    protected $guarded=[];

    public function items()
    {
        return $this->hasMany('App\item', 'item_type_id', 'id');
    }
}
