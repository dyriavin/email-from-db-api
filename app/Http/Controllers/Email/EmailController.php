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
            ['key' => 'required',
             'start_date' => 'nullable']
        ));
    }

    public function search(array $data)
    {
        $key = base64_decode($data['key']);
        $hash = $data['key'];
        $user = User::find(auth()->id());
        $limit = $user->credit->credit;
        $from = $data['start_date'];
        $to = Carbon::today()->toDateString();

        $emails = self::getEmails($from, $to, $limit,$key);
        $emails = $emails['preview'];
        return view('user.front',compact('emails','from','to','hash'));
    }


    public static function getEmails(string $from = null, string $to = null, int $limit = 0,string $email = null)
    {
        if (is_null($from) || is_null($to)) {
            return self::fetch($limit,$email);
        } else {
            return self::fetchByDate($limit, $from, $to,$email);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $ids
     * @return void
     */
    public static function update($ids)
    {
        Email::whereIn('id',$ids)->update(['given_to_user' => 1]);
    }

    public static function fetch(int $limit,string $senderEmail)
    {
        return [
            'preview' => Email::where([
                ['given_to_user', '=', 0],
                ['sender_email','=',$senderEmail]])
                ->take(20)
                ->orderBy('send_date', 'ASC')
                ->get(),
            'total' => Email::where([
                ['given_to_user', '=', 0],
                ['sender_email','=',$senderEmail]])
                ->take($limit)
                ->get(),
        ];
    }

    public static function fetchByDate(int $limit, string $from, string $to,string $senderEmail)
    {
        return [
            'preview' => Email::where([
                ['given_to_user', '=', 0],
                ['sender_email','=',$senderEmail]])
                ->whereBetween('send_date', [$from, $to])
                ->take(20)
                ->get(),
            'total' => Email::where([
                ['given_to_user', '=', 0],
                ['sender_email','=',$senderEmail]])
                ->whereBetween('send_date', [$from, $to])
                ->take($limit)
                ->get()
        ];
    }
}
