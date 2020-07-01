<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $fillable = [
        'holder', 'make', 'number', 'expiration_month', 'expiration_year', 'cvv'
    ];
}
