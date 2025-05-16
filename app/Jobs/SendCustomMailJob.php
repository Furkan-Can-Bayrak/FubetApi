<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\SendCustomMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendCustomMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $user;
    protected $details;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, array $details)
    {
        $this->user = $user;
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new SendCustomMail($this->details));
    }
}
