<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\TaskCompleted;
use App\Mail\TaskCompletedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTaskCompletedMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskCompleted $event): void
    {
        $users = User::where('role_id', 1)->get();

        foreach($users as $user) {
            try {
                Mail::to($user)->send(new TaskCompletedMail($user, $event->id));
            } catch(\Throwable $t) {
            }
        }
    }
}
