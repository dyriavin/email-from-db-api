<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CleanUpDB;
use App\Models\SenderEmail;
use Illuminate\Http\Request;

class SenderEmailController extends Controller
{
    public function confirm(Request $request)
    {
        $email = SenderEmail::find($request->id);
        $email->is_allowed = true;
        $email->save();

        $ids = SenderEmail::where('sender_email', '=', $email->sender_email)->pluck('id');
        SenderEmail::whereIn('id', $ids)->update(['is_allowed' => true]);

        CleanUpDB::cleanUp(auth()->user());

        return response(["email $email->sender_email was confirmed"]);
    }

    public function decline(Request $request)
    {
        $email = SenderEmail::find($request->id);
        $email->is_allowed = false;
        $email->save();
        $ids = SenderEmail::where('sender_email', '=', $email->sender_email)->pluck('id');
        SenderEmail::whereIn('id', $ids)->update(['is_allowed' => false]);

        CleanUpDB::cleanUp(auth()->user());

        return response(["email $email->sender_email was declined"]);
    }
}
