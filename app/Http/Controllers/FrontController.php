<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class FrontController
 * @package App\Http\Controllers
 */
class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('guest.auth');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function indexHome(){
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.index');
        }
        return view('user.search');
    }

}
