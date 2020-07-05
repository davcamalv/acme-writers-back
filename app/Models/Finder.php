<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finder extends Model
{
    protected $table = 'Finder';

    protected $fillable = [
        'keyword', 'language', 'genre', 'last_update'];

    public function books()
    {
        return $this->belongsToMany('App\Models\Book');
    }

}
