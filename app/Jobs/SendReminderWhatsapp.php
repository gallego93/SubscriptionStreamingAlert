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
use App\Providers\WhatsappServiceProvider;
use App\Traits\LogTrait;

class SendReminderWhatsapp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogTrait;

    /**
     * The Twilio WhatsApp Service instance.
     *
     * @var TwilioWhatsappService
     */
    protected $whatsappService;

    /**
     * Create a new command instance.
     *
     * @param TwilioWhatsappService $whatsappService
     */
    public function __construct(WhatsappServiceProvider $whatsappService)
    {
        $this->whatsappService = $whatsappService;
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
                ->where('clients.whatsapp_send', true)
                ->select('subscriptions.*')
                ->get();
            $whatsAppMessage = Message::latest()->first();

            if (!$whatsAppMessage) {
                $this->logWarning('No message found in the database.');
                return;
            }

            //$this->logInfo('Message content: ' . $whatsAppMessage->message);

            foreach ($subscriptions as $subscription) {
                $client = Clients::find($subscription->client_id);
                if ($client && $client->phone && $client->whatsapp_send) {
                    $this->logInfo('Sending WhatsApp message to ' . $client->phone);
                    try {
                        $response = $this->whatsappService->sendWhatsappMessage($client->phone, $whatsAppMessage);
                        $this->logInfo('Whatsapp message sent successfully to ' . $client->phone);
                    } catch (\Exception $e) {
                        $this->logError($e, 'Failed to send WhatsApp message to ' . $client->phone);
                    }
                } else {
                    $this->logWarning('Client not found or phone number missing for subscription ID: ' . $subscription->id);
                }
            }
        } catch (\Exception $e) {
            $this->logError($e, 'Error while sending WhatsApp reminders: ');
        }
    }
}
