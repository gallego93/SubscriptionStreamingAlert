<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <head>
        <title>Recordatorio de Suscripción</title>
    </head>
    <body>
        <h1>Recordatorio</h1>
        <p>Estimado/a {{ $subscription->client->name }},</p>

        <p>Le informamos que su suscripción a {{ $subscription->product->name }} expirará el {{ $subscription->final_date }}. Para renovarla y evitar interrupciones, por favor contáctenos en gallegodev93@gmail.com o 3162498060.</p>
            
        <p>Gracias por su preferencia.</p>
        
        <p>Atentamente,</p>

        <p>Daniel Steven Gallego Castillo <br>
           GallegoDev</p>
    </body>
    </html>