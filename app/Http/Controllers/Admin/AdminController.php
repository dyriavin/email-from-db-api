<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DebugController;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        $emailsLeft = Email::where('given_to_user','=',0)->count();
        $emailsUsed = Email::where('given_to_user','=',1)->count();
        $emailData = [
            'total' => $emailsLeft + $emailsUsed,
            'left' => $emailsLeft,
            'used' => $emailsUsed,
        ];
        $jobs = DebugController::jobs();

        return view('admin.home',compact('users','emailData','jobs'));
    }
}
