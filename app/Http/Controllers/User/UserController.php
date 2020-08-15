<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Email\EmailController;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $user = User::findOrFail(auth()->id());
        return view('user.front');
    }
    public function indexHome()
    {
        return view('user.search');
    }
    private function checkCredit()
    {
        $user = User::find(auth()->id());

    }

}
