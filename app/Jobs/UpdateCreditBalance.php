<?php

namespace App\Jobs;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class UpdateCreditBalance
 * @package App\Jobs
 */
class UpdateCreditBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $userId;
    /**
     * @var int
     */
    protected $credit;

    /**
     * Create a new job instance.
     *
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->credit = rand(11000,14213);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->userId);
        $user->credit()->update(['credit' => $this->credit]);
    }
}
