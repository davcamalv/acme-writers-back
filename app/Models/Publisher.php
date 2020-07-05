<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'Publiser';

    protected $fillable = [
        'VAT', 'comercial_name'];

    public function creditCard()
    {
        return $this->hasOne('App\Models\CreditCard');
    }

}
