<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    // If you want to use the Site 2 database:
    protected $connection = 'mysql_site2'; 

    protected $table = 'movies';
    protected $fillable = ['title', 'genre'];
}