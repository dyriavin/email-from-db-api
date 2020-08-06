<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Email\EmailController;
use App\Models\Email;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExportController extends BaseEmailController
{
    public function export(? string $from = null,? string $to = null)
    {

        $fileName = Carbon::now()->toDateString()."-file.csv";
        $emails = EmailController::getEmails($from,$to,auth()->user()->credit->credit);

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'EMAIL', 'SENDER EMAIL', 'DELIVERY STATUS ', 'SEND DATE'];
        $callback = function() use($emails, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($emails['total'] as $email) {
                $row['ID']  = $email->id;
                $row['EMAIL']    = $email->email;
                $row['SENDER EMAIL']    = $email->sender_email;
                $row['DELIVERY STATUS']  = $email->delivery_status;
                $row['SEND DATE']  = $email->send_date;

                fputcsv($file, [$row['ID'], $row['EMAIL'], $row['SENDER EMAIL'], $row['DELIVERY STATUS'], $row['SEND DATE']]);
            }

            fclose($file);
        };


        return response()->stream($callback, 200, $headers);
    }
}
