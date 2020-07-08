<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $table = 'readers';



    public function finder()
    {
        return $this->belongsTo('App\Models\Finder');
    }

    public function books()
    {
        return $this->belongsToMany('App\Models\Book');
    }

    public function user()
    {
        return $this->morphOne('App\Models\User', 'actor');
    }

    public function opinions()
    {
        return $this->hasMany('App\Models\Opinion');
    }

}
