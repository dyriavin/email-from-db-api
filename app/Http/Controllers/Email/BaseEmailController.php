<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class   BaseEmailController extends Controller
{
    public static function insertEmailData(array $emailData)
    {
        $data = Validator::make($emailData, [
                'user_id' => ['integer'],
                'mailing_id' => ['integer'],
                'client_ip' => ['nullable','string'],
                'key' => ['required','email']]);
        $ids = Email::where('given_to_user','=',0)->take(auth()->user()->credit->credit)->pluck('id');

        $insert = $data->valid();
        Email::whereIn('id',$ids)->update(['user_id'=> $insert['user_id'],
            'mailing_id' => $insert['mailing_id'],
            'sender_email' => $insert['key']]);
        return true;
    }

}
