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
        $insert = self::validateInput($emailData);

        $ids = self::fetchIds();

        $data = self::updateEmails($ids, $insert);

        return true;
    }

    public static function validateInput(array $data)
    {
        $result = Validator::make($data, [
            'user_id' => ['integer'],
            'mailing_id' => ['integer'],
            'client_ip' => ['nullable', 'string'],
            'start_date' => ['nullable'],
            'key' => ['required', 'email']]);
        return $result->validated();
    }


    private static function fetchIds()
    {
        $limit = auth()->user()->credit->credit;
        return Email::where('given_to_user', '=', 0)->take($limit)->pluck('id');
    }

    private static function updateEmails($ids, array $data)
    {
        return Email::whereIn('id', $ids)->update(['user_id' => $data['user_id'],
            'mailing_id' => $data['mailing_id'],
            'sender_email' => $data['key']]);
    }
}
