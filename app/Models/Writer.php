<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $table = 'writers';

    public function creditCard()
    {
        return $this->belongsTo('App\Models\CreditCard');
    }

    public function user()
    {
        return $this->morphOne('App\Models\User', 'actor');
    }

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
}
