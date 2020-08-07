<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateCreditBalance;
use App\Models\UserCredit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserCreditController extends Controller
{

    public static function updateCreditBalance(int $id)
    {
        $time = Carbon::now()->addSeconds(75);

        if (app()->env == 'production') {
            $time = Carbon::now()->addMinutes(60);
        }

        dispatch(new UpdateCreditBalance($id))
            ->delay($time);
    }
}
