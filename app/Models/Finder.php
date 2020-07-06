<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finder extends Model
{
    protected $table = 'finders';

    protected $fillable = [
        'keyword', 'language', 'genre', 'last_update'];

    public function books()
    {
        return $this->belongsToMany('App\Models\Book');
    }

    public function reader()
    {
        return $this->hasOne('App\Models\Reader');
    }
}
