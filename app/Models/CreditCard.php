<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'credit_cards';

    protected $fillable = [
        'holder', 'make', 'number', 'expiration_month', 'expiration_year', 'cvv'
    ];

    public function writer()
    {
        return $this->hasOne('App\Models\Writer');
    }

    public function publisher()
    {
        return $this->hasOne('App\Models\Publisher');
    }
}
