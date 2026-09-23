<?php

namespace App\Jobs;

use App\Mail\InvitationMail;
use App\Models\UserInvitations;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendInvitationMail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public UserInvitations $invitation)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->invitation->email)
            ->send(new InvitationMail($this->invitation));
    }
}
