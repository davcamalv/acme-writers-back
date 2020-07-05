<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $table = 'Reader';



    public function finder()
    {
        return $this->hasOne('App\Models\Finder');
    }

    public function books()
    {
        return $this->belongsToMany('App\Models\Book');
    }

}
