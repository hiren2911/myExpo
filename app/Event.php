<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //

    public function stands() {
        return $this->hasMany('App\Stand');
    }

    public function users()
    {
        return $this->hasManyThrough('App\Stand', 'App\User');
    }
}
