<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'email',
        'username',
        'password',
    ];

    protected $visible = [
        'username'
    ];
}
