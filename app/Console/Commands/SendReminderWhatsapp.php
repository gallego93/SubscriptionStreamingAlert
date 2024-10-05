<?php

namespace App\Console\Commands;

use Illuminate\Support\Carbon;
use App\Models\Subscriptions;
use App\Models\Message;
use App\Models\Clients;
use Illuminate\Console\Command;
use App\Providers\WhatsappServiceProvider;
use App\Traits\LogTrait;

class SendReminderWhatsapp extends Command
{
    use LogTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a WhatsApp reminder using Twilio';

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
        parent::__construct();
        $this->whatsappService = $whatsappService;
    }

    /**
     * Execute the console command.
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
