<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateCreditBalance;
use Carbon\Carbon;

/**
 * Class UserCreditController
 * @package App\Http\Controllers
 */
class UserCreditController extends Controller
{

    /**
     * @param int $id
     */
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
