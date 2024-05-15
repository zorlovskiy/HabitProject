<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Mail\HabitReadyProgress;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailReadyProgress
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
    public function handle(SendMail $event): void
    {
        Mail::to($event->user)->send(new HabitReadyProgress($event->user, $event->habit));
    }
}
