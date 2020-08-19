<?php

namespace App\Http\Controllers\Email;

use App\Events\SenderEmailCreated;
use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\SenderEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class   BaseEmailController extends Controller
{
    /**
     * @param array $emailData
     * @return bool
     */
    public static function insertEmailData(array $emailData)
    {
            $insert = self::validateInput($emailData);

            $ids = self::fetchIds();
            $senderEmail = self::fetchOrCreateSenderEmail($emailData['sender_email']);
            event(new SenderEmailCreated($senderEmail));

            $data = self::updateEmails($ids, $insert);

            return true;
    }
    private static function fetchOrCreateSenderEmail($email)
    {
        $senderEmail = '';
        try {
            $senderEmail = SenderEmail::where(['sender_email','=',[$email]])->first();

        } catch (\Exception $exception) {
            $senderEmail = SenderEmail::create(['sender_email' => $email])->first();
        }

        return $senderEmail;
    }
    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validateInput(array $data)
    {
        $result = Validator::make($data, [
            'user_id' => ['integer'],
            'mailing_id' => ['integer'],
            'client_ip' => ['nullable', 'string'],
            'start_date' => ['nullable'],
            'sender_email' => ['required']]);
        return $result->validated();
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    private static function fetchIds()
    {
        $limit = auth()->user()->credit->credit;
        return Email::where('given_to_user', '=', 0)->take($limit)->pluck('id');
    }

    /**
     * @param $ids
     * @param array $data
     * @return int
     */
    private static function updateEmails($ids, array $data)
    {
        return Email::whereIn('id', $ids)->update(['user_id' => $data['user_id'],
            'mailing_id' => $data['mailing_id'],
            'sender_email' => $data['sender_email']]);
    }
}
