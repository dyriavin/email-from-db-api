<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailDateStamp extends Model
{
    protected $fillable = [
        'user_id',
        'date_export',
        'time_export'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
