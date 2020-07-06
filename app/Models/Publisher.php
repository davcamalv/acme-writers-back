<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';

    protected $fillable = [
        'VAT', 'comercial_name'];

    public function creditCard()
    {
        return $this->belongsTo('App\Models\CreditCard');
    }

    public function user()
    {
        return $this->morphOne('App\Models\User', 'actor');
    }
}
