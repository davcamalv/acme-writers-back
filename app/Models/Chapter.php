<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapters';

    protected $fillable = [
        'title', 'number', 'text'];

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
}
