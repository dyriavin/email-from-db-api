<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SenderEmail extends Model
{
    protected $fillable = [
        'sender_email'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
