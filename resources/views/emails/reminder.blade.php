<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recordatorio de Suscripción</title>
</head>

<body>
    <p>Hola {{ $subscription->Client->name }}, </p>

    <p>{!! $emailMessage->message !!}</p>

</body>

</html>