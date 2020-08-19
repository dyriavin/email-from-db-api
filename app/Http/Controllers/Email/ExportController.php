<?php

namespace App\Http\Controllers\Email;

use App\Events\ChargeUser;
use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserCreditController;
use App\Jobs\UpdateCreditBalance;
use App\Models\Email;
use App\Models\SenderEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class ExportController
 * @package App\Http\Controllers\Email
 */
class ExportController extends BaseEmailController
{
    /**
     * @param string|null $hash
     * @param string|null $from
     * @param string|null $to
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export(?string $hash, ?string $from = null, ?string $to = null)
    {
        $user = auth()->user();
        $limit = $user->credit->credit;

        $key = base64_decode($hash);
        $filename = self::generateFilename();
        $senderEmail = SenderEmail::where('sender_email','=',$key)->first();
        if ($senderEmail == null) {
            return redirect()->route('email.index')->withErrors('Попробуй ещё раз ');
        }
        if ($senderEmail->is_allowed) {
            $emails = EmailController::getEmails($from, $to, $limit, $key);

            $headers = self::headers($filename);

            $columns = ['EMAIL', 'USER_ID', 'MAILING_ID', 'SENDER EMAIL'];

            $callback = function () use ($emails, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($emails as $email) {
                    $row['EMAIL'] = $email->email;
                    $row['USER_ID'] = $email->user_id;
                    $row['MAILING_ID'] = $email->mailing_id;
                    $row['SENDER EMAIL'] = $email->sender_email;
                    fputcsv($file, [$row['EMAIL'], $row['USER_ID'], $row['MAILING_ID'], $row['SENDER EMAIL']]);
                }

                fclose($file);
            };

            $credit = UserController::creditLeft($limit);

            event(new ChargeUser($user, $limit, $credit));

            EmailController::update($emails->pluck('id'));
            auth()->user()->senderEmail()->delete();
            return response()->stream($callback, 200, $headers);
        }
        return response('Connection Error',504);
    }

    private function headers(string $filename)
    {
        return [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
    }
    private function generateFilename()
    {
        return Carbon::now()->toDateString() . "-file.csv";
    }
}
