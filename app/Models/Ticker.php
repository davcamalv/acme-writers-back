<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    protected $table = 'tickers';

    protected $fillable = [
        'identifier'];

    public function book()
    {
        return $this->hasOne('App\Models\Book');
    }
}
