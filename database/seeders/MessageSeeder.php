<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use GuzzleHttp\Promise\Create;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create([
            'name' => 'Alerta de suscripcion',
            'message' => 'Hola Daniel Steven Gallego Castillo,
            Queremos informarte que tu suscripción está próxima a vencer. La fecha de vencimiento
            sera en 8 días calendario contados a partir de la recepción de este mensaje.
            
            Para que no te pierdas ningún contenido, te recomendamos renovar tu suscripción antes
            de esa fecha. Así podrás seguir disfrutando de tus series, películas y programas favoritos
            sin interrupciones.
            
            Puedes renovar tu suscripción fácilmente contactando a tu asesor haciendo clic en el
            siguiente enlace: https://wa.me/573162498060/?text=Quiero%20renovar%20mi%20suscripcion!.
            
            Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos. Estamos aquí
            para asistirte en lo que necesites.
            
            ¡Gracias por ser parte de GallegoStreamig! Esperamos seguir entreteniéndote.
            
            Saludos cordiales,
            
            Gallego Daniel
            Asesor de Producto
            GallegoStreaming',
            'user_id' => '1'
        ]);
    }
}
