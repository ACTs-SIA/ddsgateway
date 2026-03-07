<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
class User extends Model
{
    protected $table = "users";

    protected $fillable = [
        'username',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;
}