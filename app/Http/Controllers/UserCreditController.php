<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateCreditBalance;
use App\Models\UserCredit;
use Illuminate\Http\Request;

class UserCreditController extends Controller
{
    public static function updateCreditBalance(int $id)
    {
        dispatch(new UpdateCreditBalance($id))->delay(now()->addSeconds(15));
    }
}
