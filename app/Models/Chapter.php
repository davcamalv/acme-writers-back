<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'Chapter';

    protected $fillable = [
        'title', 'number', 'text'];

    public function book()
    {
        return $this->hasOne('App\Models\Book');
    }
}
