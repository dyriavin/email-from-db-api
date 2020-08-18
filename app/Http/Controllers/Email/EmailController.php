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
        dd($request->input());
        $data = $request->validate(['key' => 'required',
            'sender_email' => 'required',
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
        $hash = base64_encode($input['key']);
        dd($hash);
        $user = User::find(auth()->id());

        $limit = $user->credit->credit;

        $from = $data['start_date'];

        $to = Carbon::today()->toDateString();

        if ($limit == 0) {
            return view('user.error')->withErrors(['Будет доступно через 1 час']);
        }
        $emails = self::getEmailsForPreview($from, $to,$input['key']);

        return view('user.front',compact('emails','from','to','hash'));
    }

    private static function getEmailsForPreview(string $from = null,string $to = null,string $email = null)
    {
        if (is_null($from) || is_null($to)) {
            return self::fetch(20,$email);
        } else {
            return self::fetchByDate(20, $from, $to,$email);
        }
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
        $emails = '';
        if (is_null($from)) {
            $emails = self::fetch($limit,$email);
            return $emails;
        } else {
            $emails = self::fetchByDate($limit, $from, $to,$email);
            return $emails;
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
        return Email::where([
                ['given_to_user', '=', 0],
                ['sender_email', '=', $senderEmail]])
                ->take($limit)
                ->get();
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
        return Email::where([
                ['given_to_user', '=', 0],
                ['sender_email', '=', $senderEmail]])
                ->whereBetween('send_date', [$from, $to])
                ->take($limit)
                ->get();
    }
}
