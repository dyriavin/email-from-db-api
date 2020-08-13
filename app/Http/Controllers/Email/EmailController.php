<?php

namespace App\Http\Controllers\Email;

use App\Models\Email;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\Node\Expr\Cast\Object_;

/**
 * Class EmailController
 * @package App\Http\Controllers\Email
 */
class EmailController extends BaseEmailController
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.search');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchResults()
    {
        return view('user.front');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submit(Request $request)
    {
        $data = $request->validate(['key' => 'required',
            'user_id' => 'nullable|integer',
            'mailing_id' => 'nullable|integer',
            'client_ip' => 'nullable|string',
            'start_date' => 'nullable']);

        $data['key'] = base64_decode($data['key']);
        BaseEmailController::insertEmailData($data);

        return self::search($data);
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(array $data)
    {
        $input = BaseEmailController::validateInput($data);
        $withDate = self::isWithDateRequest($data);

        $hash = $data['key'];
        $user = User::find(auth()->id());
        $limit = $user->credit->credit;
        $from = $data['start_date'];

        $to = Carbon::today()->toDateString();

        $emails = self::getEmails($from, $to, $limit,$input['key']);
//        dd($emails);
        $emails = $emails['preview'];
        if ($limit == 0) {
            return view('user.error')->withErrors(['Будет доступно через 1 час']);
        }
        return view('user.front',compact('emails','from','to','hash'));
    }

    private static function isWithDateRequest(array $data): bool
    {
        if (!is_null($data['start_date'])){
            return true;
        }
        return false;
    }

    /**
     * @param string|null $from
     * @param string|null $to
     * @param int $limit
     * @param string|null $email
     * @return array
     */
    public static function getEmails(string $from = null, string $to = null, int $limit = 0, string $email = null)
    {
        if (is_null($from) || is_null($to)) {
            return self::fetch($limit,$email);
        } else {
            return self::fetchByDate($limit, $from, $to,$email);
        }
    }

    /**
     * @param $ids
     */
    public static function update($ids)
    {
        Email::whereIn('id',$ids)->update(['given_to_user' => 1]);
    }

    /**
     * @param int $limit
     * @param string $senderEmail
     * @return array
     */
    public static function fetch(int $limit, string $senderEmail)
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

    /**
     * @param int $limit
     * @param string $from
     * @param string $to
     * @param string $senderEmail
     * @return array
     */
    public static function fetchByDate(int $limit, string $from, string $to, string $senderEmail)
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
