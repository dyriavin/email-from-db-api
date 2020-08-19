<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramController extends Controller
{
    private const TOKEN = '1261541502:AAHzyjpBjvPpzk4FSsIdGfYIxxUtRXLBIfk';
    private const CHAT_ID = '-494786350';
    public static function sendNotification($data)
    {
        $token = self::TOKEN;
        $chatId = self::CHAT_ID;
        $text = '';
        $messageData = [
            'SENDER EMAIL: '=> $data->sender_email,
            'STATUS: ' => $data->is_allowed,
            'CONFIRM' => route('sender.confirm',$data->id),
            'DECLINE' => route('sender.decline',$data->id)
        ];
        foreach ($messageData as $key => $data ) {
            $text .= "<code>".$key."</code> ".$data."%0A";
        };
        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chatId}&parse_mode=html&text={$text}","r");
        if ($sendToTelegram) {
            return true;
        } else {
            return false;
        }
    }
}
