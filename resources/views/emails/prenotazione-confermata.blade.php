<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Conferma Prenotazione</title>
</head>

<body>
    <h1>Grazie per aver prenotato con noi!</h1>
    <p>Ciao {{ $booking->nome }},</p>
    <p>La tua prenotazione per la camera <strong>{{ $booking->room->nome }}</strong> è stata confermata.</p>
    <p><strong>Check-in:</strong> {{ $booking->data_checkin }}</p>
    <p><strong>Check-out:</strong> {{ $booking->data_checkout }}</p>
    <p>Se hai domande, non esitare a contattarci.</p>
    <p>Grazie e a presto!</p>
    <p>Hotel Management</p>
</body>

</html>