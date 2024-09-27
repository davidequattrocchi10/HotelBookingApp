<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione Cancellata</title>
</head>

<body>
    <h1>Prenotazione Cancellata!</h1>
    <p>Ciao {{ $booking->nome }},</p>
    <p>La tua prenotazione per la camera {{ $booking->room->nome }} con check-in il {{ $booking->data_checkin }} è stata cancellata.</p>
    <p>Grazie per averci scelto. Speriamo di poterti accogliere in futuro.</p>
</body>

</html>