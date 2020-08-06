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
    /**
     * @param int|null $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getEmailData(? int $limit = 20)
    {
       return $emails = Email::paginate($limit);
    }

    /**
     * Display a listing of the resource.
     *
     * @param EmailRequest $request
     * @return void
     */
    public function index(EmailRequest $request)
    {
        $user = User::find(auth()->id());
        $limit = $user->credit->credit;
        $from = $request->start_date;
        $to = $request->end_date ? null : Carbon::today()->toDateString();

        if (is_null($from) || is_null($to)) {
            $emails = self::fetch($limit);
        }
        $emails = self::fetchByDate($limit,$from,$to);
        dd($emails);
    }

    /**
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function fetch(int $limit) : \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
           return Email::where('given_to_user','>',0)
               ->take($limit)
               ->paginate(20);
    }

    /**
     * @param int $limit
     * @param string $from
     * @param string $to
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function fetchByDate(int $limit, string $from, string $to) : \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {

        return  Email::where('given_to_user','>',0)
            ->whereBetween('send_date',[$from,$to])
            ->take($limit)->paginate(20);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
