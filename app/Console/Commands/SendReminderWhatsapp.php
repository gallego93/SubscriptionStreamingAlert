<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Providers\WhatsAppServiceProvider;
use Illuminate\Support\Facades\Log;

class SendReminderWhatsapp extends Command
{
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
    protected $description = 'Command description';

    protected $whatsappService;

    public function __construct(WhatsAppServiceProvider $whatsappService)
    {
        parent::__construct();
        $this->whatsappService = $whatsappService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

        Log::info('SendReminderWhatsapp command started.');

        try {
            // Aquí puedes definir la lógica para obtener los mensajes y destinatarios
            // programados desde la base de datos o cualquier otra fuente.

            // Ejemplo de mensajes programados
            $scheduledMessages = [
                [
                    'to' => '573162498060', // Reemplaza con el número de teléfono destinatario
                    'message' => 'Este es un mensaje programado.'
                ],
                // Agrega más mensajes programados según sea necesario
            ];

            foreach ($scheduledMessages as $message) {
                $this->whatsappService->sendMessage($message['to'], $message['message']);
            }
        } catch (\Exception $e) {
            Log::error('Error in SendReminderWhatsapp: ' . $e->getMessage());
        }

        Log::info('SendReminderWhatsapp command finished.');
    }
}
