<?php

namespace App\Http\Controllers\Email;

use App\Models\Email;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\Cast\Object_;

class EmailController extends BaseEmailController
{

    public function index()
    {
        return view('user.search');
    }

    public function searchResults()
    {
        return view('user.front');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return string
     */
    public function submit(Request $request)
    {
        return self::search($request->validate(
            ['api_key' => 'required',
             'start_date' => 'nullable']
        ));
    }

    public function search(array $data)
    {
        $apiKey = base64_decode($data['api_key']);

        $user = User::find(auth()->id());
        $limit = $user->credit->credit;
        $from = $data['start_date'];
        $to = Carbon::today()->toDateString();

        $emails = self::getEmails($from, $to, $limit);
        return view('user.front',compact('emails','from','to','apiKey'));
    }


    public static function getEmails(string $from = null, string $to = null, int $limit = 0)
    {
        if (is_null($from) || is_null($to)) {
            return self::fetch($limit);
        } else {
            return self::fetchByDate($limit, $from, $to);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Email $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    public static function fetch(int $limit)
    {
        return [
            'preview' => Email::where('given_to_user', '=', 0)
                ->take(20)->orderBy('send_date', 'ASC')->get(),
            'total' => Email::where('given_to_user', '=', 0)
                ->take($limit)->get(),
        ];
    }

    public static function fetchByDate(int $limit, string $from, string $to)
    {
        return [
            'preview' => Email::where('given_to_user', '=', 0)
                ->whereBetween('send_date', [$from, $to])
                ->take(20)->get(),
            'total' => Email::where('given_to_user', '=', 0)
                ->whereBetween('send_date', [$from, $to])
                ->take($limit)->get()
        ];
    }
}
