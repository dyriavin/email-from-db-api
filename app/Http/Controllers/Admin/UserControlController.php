<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserControlController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBalance(Request $request)
    {
        $user = User::find($request->user_id);
        $user->credit->update(['credit' => $request->credit ]);
        return redirect()
            ->back()
            ->with('success','Баланс был обновлён');
    }
}
