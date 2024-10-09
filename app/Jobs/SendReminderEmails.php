<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use App\Models\Subscriptions;
use App\Models\Message;
use App\Models\Clients;
use Illuminate\Support\Facades\Mail;
use App\Traits\LogTrait;

class SendReminderEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogTrait;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $date = Carbon::now()->addDays(8)->toDateString();
            $subscriptions = Subscriptions::where('final_date', $date)
                ->where('status', true)
                ->join('clients', 'subscriptions.client_id', '=', 'clients.id')
                ->where('clients.email_send', true)
                ->select('subscriptions.*')
                ->get();

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
