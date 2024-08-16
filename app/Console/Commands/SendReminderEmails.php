<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscriptions;
use App\Models\Clients;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails 8 days before the subscription date';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('SendReminderEmails command started.');

        try {
            $date = Carbon::now()->addDays(8)->toDateString();
            $subscriptions = Subscriptions::where('final_date', $date)->get();

            foreach ($subscriptions as $subscription) {
                $client = Clients::find($subscription->client_id);
                if ($client) {
                    Log::info('Sending email to ' . $client->email);
                    Mail::to($client->email)->send(new \App\Mail\ReminderEmail($subscription));
                } else {
                    Log::warning('Client not found for subscription ID: ' . $subscription->id);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error in SendReminderEmails: ' . $e->getMessage());
        }

        Log::info('SendReminderEmails command finished.');
    }
}