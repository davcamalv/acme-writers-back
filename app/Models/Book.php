<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title', 'description', 'language', 'genre', 'cover', 'cancelled', 'status', 'draft'
    ];

    public function ticker()
    {
        return $this->belongsTo('App\Models\Ticker');
    }

    public function publisher()
    {
        return $this->hasOne('App\Models\Publisher');
    }

    public function writer()
    {
        return $this->belongsTo('App\Models\Writer');
    }
}
