<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;

class   BaseEmailController extends Controller
{
    public static function insertEmailData(array $emailData)
    {
        $records = Email::where('given_to_user','=',0)->take(auth()->user()->credit->credit)->pluck('id');

//        Email::whereIn()->update(['sender_email' => $emailData]);

    }

}
