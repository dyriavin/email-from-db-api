<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class DebugController
 * @package App\Http\Controllers
 */
class DebugController extends Controller
{
    /**
     * @return array
     */
    public static function index()
    {
        $jobs = DB::table('jobs')->get();
        $balances = DB::table('user_credits')->get();
        return [
            'jobs' => $jobs,
            'balances' => $balances
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function jobs(){
        return DB::table('jobs')
            ->get();
    }
}
