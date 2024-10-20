<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;
use App\Models\Setting;

class WhatsappServiceProvider extends ServiceProvider
{
    protected $twilio;
    protected $twilioPhone;

    public function __construct()
    {
        $twilioSid = Setting::where('key', 'TWILIO_SID')->value('value');
        $twilioToken = Setting::where('key', 'TWILIO_TOKEN')->value('value');
        $this->twilioPhone = Setting::where('key', 'TWILIO_PHONE')->value('value');

        $this->twilio = new Client($twilioSid, $twilioToken);
    }

    public function sendWhatsappMessage($to, $message)
    {
        return $this->twilio->messages->create(
            "whatsapp:" . $to,
            [
                'from' => $this->twilioPhone,
                'body' => $message,
            ]
        );
    }
}
