<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $connection = 'mysql_site2'; 

    protected $table = 'movies';

    protected $fillable = [
        'title',
        'genre',
    ];
}