<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $table = 'Writer';

    public function creditCard()
    {
        return $this->hasOne('App\CreditCard');
    }

    public function user()
    {
        return $this->morphOne('App\User', 'actor');
    }
}
