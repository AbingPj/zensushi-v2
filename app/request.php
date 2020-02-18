<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class request extends Model
{
    protected $guarded = [];

    public function request_lists()
    {
        return $this->hasMany(request_list::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
