<?php

namespace App\Http\Controllers;

use App\Models\SenderEmail;
use Illuminate\Http\Request;

class SenderEmailController extends Controller
{
    public function confirm(Request $request){
       $email = SenderEmail::find($request->id);
       $email->is_allowed = true;
       $email->save();
       return response(["email $email->sender_email was confirmed"]);
    }
    public function decline(Request $request){
        $email = SenderEmail::find($request->id);
        $email->is_allowed = false;
        $email->save();
        return response(["email $email->sender_email was declined"]);
    }
}
