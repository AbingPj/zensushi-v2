<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function unit()
    {
        return $this->belongsTo('App\Unit', 'unit_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
    public function item_type()
    {
        return $this->belongsTo('App\Item_type', 'item_type_id', 'id');
    }

    public function raw()
    {
        return $this->hasOne('App\Raw', 'item_id', 'id');
    }

    public function raw_product()
    {
        return $this->hasOne('App\Raw_product', 'item_id', 'id');
    }

    public function not_raw()
    {
        return $this->hasOne('App\Not_raw', 'item_id', 'id');
    }

    public function in_records()
    {
        return $this->hasMany('App\In_record', 'item_id', 'id');
    }
    public function out_records()
    {
        return $this->hasMany('App\Out_record', 'item_id', 'id');
    }
    public function scraps()
    {
        return $this->hasMany('App\Scrap', 'item_id', 'id');
    }
    public function bones()
    {
        return $this->hasMany('App\Bones', 'item_id', 'id');
    }
    public function additionals()
    {
        return $this->hasMany('App\Additional', 'item_id', 'id');
    }
}
