<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscriptions;
use App\Models\Clients;
use App\Models\Message;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Traits\LogTrait;

class SendReminderEmails extends Command
{
    use LogTrait;
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
        try {
            $date = Carbon::now()->addDays(8)->toDateString();
            $subscriptions = Subscriptions::where('final_date', $date)->get();
            $emailMessage = Message::latest()->first();

            if (!$emailMessage) {
                $this->logWarning('No message found in the database.');
                return;
            }

            //$this->logInfo('Message content: ' . $emailMessage->message);

            foreach ($subscriptions as $subscription) {
                $client = Clients::find($subscription->client_id);
                if ($client && $client->email) {
                    $this->logInfo('Sending Email to ' . $client->email);
                    try {
                        Mail::to($client->email)->send(new \App\Mail\ReminderEmail($subscription, $emailMessage));
                        $this->logInfo('Email sent successfully to ' . $client->email);
                    } catch (\Exception $e) {
                        $this->logError($e, 'Failed to send Email to ' . $client->email);
                    }
                } else {
                    $this->logWarning('Client not found or Email missing for subscription ID: ' . $subscription->id);
                }
            }
        } catch (\Exception $e) {
            $this->logError($e, 'Error while sending Email reminders ');
        }
    }
}
