<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebugController extends Controller
{
    public static function index()
    {
        $jobs = DB::table('jobs')->get();
        $balances = DB::table('user_credits')->get();
        return [
            'jobs' => $jobs,
            'balances' => $balances
        ];
    }
}
