<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $table = 'Writer';

    public function creditCard()
    {
        return $this->hasOne('App\Models\CreditCard');
    }

    public function user()
    {
        return $this->morphOne('App\Models\User', 'actor');
    }
}
