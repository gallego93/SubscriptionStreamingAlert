<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\UpdateSubscriptionState;
use App\Jobs\SendReminderEmails;
use App\Jobs\SendReminderWhatsapp;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(SendReminderEmails::class)->dailyAt('09:00');
        $schedule->job(SendReminderWhatsapp::class)->dailyAt('09:00');
        $schedule->job(UpdateSubscriptionState::class)->dailyAt('00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
