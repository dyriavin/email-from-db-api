<?php

namespace App\Listeners;

use App\Http\Controllers\UserCreditController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserBalance
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->user->credit()->update(['credit' => $credit]);
        UserCreditController::updateCreditBalance($event->user->id);
    }
}
