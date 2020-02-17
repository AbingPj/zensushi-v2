<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class request_list extends Model
{
    protected $guarded = [];

    public function request()
    {
        return $this->belongsTo(request::class);
    }
}

