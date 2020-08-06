<?php

namespace App\Http\Controllers\Email;

use App\Http\Requests\EmailRequest;
use App\Models\Email;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\Cast\Object_;

class EmailController extends BaseEmailController
{

    public static function getEmailData(?int $limit = 20)
    {
        return $emails = Email::paginate($limit);
    }


    public function index(EmailRequest $request)
    {
        return view('user.results');
    }

    public function searchResults()
    {
        return view('user.front');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Email $email
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(EmailRequest $request)
    {
        $user = User::find(auth()->id());
        $limit = $user->credit->credit;
        $from = $request->start_date;
        $to = $request->end_date ? null : Carbon::today()->toDateString();
        if (is_null($from) || is_null($to)) {
            $emails = self::fetch($limit);
        } else {
            $emails = self::fetchByDate($limit,$from,$to);
        }
        return view('user.front', compact('emails'));
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

    private function fetch(int $limit)
    {
        return [
            'preview' => Email::where('given_to_user', '=', 0)
                ->take(20)->orderBy('send_date','ASC')->get(),
            'total' => Email::where('given_to_user', '=', 0)
                ->take($limit)->get(),
        ];
    }

    private function fetchByDate(int $limit, string $from, string $to)
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
