<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello di Amministrazione</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Pannello di Amministrazione</h1>

        <!-- Sezione per le camere -->
        <h2>Camere Disponibili</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Prezzo</th>
                    <th>Disponibile</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->nome }}</td>
                    <td>{{ $room->descrizione }}</td>
                    <td>€{{ $room->prezzo }}</td>
                    <td>{{ $room->disponibile ? 'Sì' : 'No' }}</td>
                    <td>
                        <a href="/admin/edit-room/{{ $room->id }}" class="btn btn-sm btn-warning">Modifica</a>
                        <a href="/admin/delete-room/{{ $room->id }}" class="btn btn-sm btn-danger">Elimina</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Sezione per le prenotazioni -->
        <h2>Prenotazioni</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome Cliente</th>
                    <th>Email</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Camera Prenotata</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->nome }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->data_checkin }}</td>
                    <td>{{ $booking->data_checkout }}</td>
                    <td>{{ $booking->room->nome }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>