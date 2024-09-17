<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazioni</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="container">
        <h1>Benvenuti al nostro hotel</h1>
        <p>Visualizza le nostre camere e prenota la tua stanza oggi stesso!</p>

        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->nome }}</h5>
                        <p class="card-text">{{ $room->descrizione }}</p>
                        <p class="card-text"><strong>Prezzo: €{{ $room->prezzo }}</strong></p>
                        <!-- Bottone per aprire la modale -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal-{{ $room->id }}">
                            Prenota ora
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modale di prenotazione -->
            <div class="modal fade" id="bookingModal-{{ $room->id }}" tabindex="-1" aria-labelledby="bookingModalLabel-{{ $room->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookingModalLabel-{{ $room->id }}">Prenotazione per {{ $room->nome }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/prenotazioni" method="POST">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">

                                <div class="form-group">
                                    <label for="nome">Nome:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="data_checkin">Check-in:</label>
                                    <input type="date" name="data_checkin" id="data_checkin" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="data_checkout">Check-out:</label>
                                    <input type="date" name="data_checkout" id="data_checkout" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Conferma Prenotazione</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#data_checkin", {
            dateFormat: "Y-m-d",
        });

        flatpickr("#data_checkout", {
            dateFormat: "Y-m-d",
        });
    </script>

</body>

</html>