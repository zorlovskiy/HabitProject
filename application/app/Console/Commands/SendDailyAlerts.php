<?php

namespace App\Console\Commands;

use App\Mail\DailyAlerts;
use App\Models\Habit;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SendDailyAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        if ($users->count() > 0) {
            foreach ($users as $user) {

                Habit::query()
                    ->where('user_id', $user->id)
                    ->each(function (Habit $habit) {

                        $dateNow = Carbon::now();
                        $endDate = $habit->endDate();
                        Mail::to($habit->user)->send(new DailyAlerts($habit->user, $habit));

                        if ($dateNow < $endDate) {


                        }

                    });
            }
        }
    }
}
