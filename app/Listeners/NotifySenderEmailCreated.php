<?php

namespace App\Listeners;

use App\Http\Controllers\TelegramController;
use App\Models\SenderEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifySenderEmailCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        TelegramController::sendNotification($event->email);
    }
}
