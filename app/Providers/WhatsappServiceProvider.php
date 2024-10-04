<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;

class WhatsappServiceProvider extends ServiceProvider
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }

    public function sendWhatsappMessage($to, $message)
    {
        return $this->twilio->messages->create(
            "whatsapp:" . $to, // El número del receptor con prefijo "whatsapp:"
            [
                'from' => config('services.twilio.whatsapp_number'), // El número autorizado de Twilio
                'body' => $message,
            ]
        );
    }
}
