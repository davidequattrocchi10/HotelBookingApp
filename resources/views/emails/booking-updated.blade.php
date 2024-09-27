<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiornamento Prenotazione</title>
</head>

<body>
    <h1>La tua prenotazione è stata aggiornata!</h1>
    <p>Ciao {{ $booking->nome }},</p>
    <p>La tua prenotazione presso il nostro hotel è stata aggiornata con i seguenti dettagli:</p>
    <ul>
        <li>Camera: {{ $booking->room->nome }}</li>
        <li>Check-in: {{ $booking->data_checkin }}</li>
        <li>Check-out: {{ $booking->data_checkout }}</li>
    </ul>
    <p>Grazie per aver scelto il nostro hotel. Non vediamo l'ora di accoglierti!</p>
</body>

</html>