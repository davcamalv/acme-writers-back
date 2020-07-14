<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $table = 'opinions';

    protected $fillable = [
        'positive', 'review', 'date'
    ];

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }

    public function reader()
    {
        return $this->belongsTo('App\Models\Reader');
    }
}
