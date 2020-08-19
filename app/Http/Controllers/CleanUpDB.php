<?php

namespace App\Http\Controllers;

use App\Jobs\CleanUpSenderEmails;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CleanUpDB extends Controller
{
    public static function cleanUp($user)
    {
        $time = Carbon::now()->addMinutes(3);

        dispatch(new CleanUpSenderEmails($user))
            ->delay($time);
    }
}
