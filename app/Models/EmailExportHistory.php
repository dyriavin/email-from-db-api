<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmailExportHistory extends Model
{
    protected $fillable = [
        'email_id',
        'sender_email',
        'delivery_status',
    ];
    function test()
    {
        $date = Carbon::now()->toDateString();
    }
}
