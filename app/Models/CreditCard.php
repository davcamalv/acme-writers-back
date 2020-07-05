<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'CreditCard';

    protected $fillable = [
        'holder', 'make', 'number', 'expiration_month', 'expiration_year', 'cvv'
    ];
}
