@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h2 class="text-3xl font-bold mb-6">Pannello di Amministrazione</h2>


    <!-- Sezione Statistiche -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card text-center shadow-lg p-4">
                <h5 class="font-bold text-xl">Occupazione Attuale</h5>
                <p class="text-3xl text-green-500">{{ $occupazione }}%</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-lg p-4">
                <h5 class="font-bold text-xl">Recensioni Ricevute</h5>
                <p class="text-3xl text-blue-500">{{ $recensioni_totali }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-lg p-4">
                <h5 class="font-bold text-xl">Entrate Totali</h5>
                <p class="text-3xl text-purple-500">€{{ $entrate_totali }}</p>
            </div>
        </div>
    </div>

    <!-- Sezione Grafici -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <canvas id="occupazioneGrafico"></canvas>
        </div>
        <div class="col-md-6 mb-4">
            <canvas id="entrateGrafico"></canvas>
        </div>
    </div>


    <!-- Sezione per le camere -->
    <h2>Camere Disponibili</h2>
    <table class="table table-striped">
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
                    <!-- Bottone modifica collegato alla vista di modifica -->
                    <a href="{{ route('admin.edit-room', $room->id) }}" class="btn btn-sm btn-warning">Modifica</a>

                    <!-- Bottone elimina collegato alla funzione di eliminazione -->
                    <a href="{{ route('admin.delete-room', $room->id) }}" class="btn btn-sm btn-danger"
                        onclick="return confirm('Sei sicuro di voler eliminare questa camera?')">Elimina</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bottone per aggiungere una nuova camera collegato alla vista di creazione -->
    <a href="{{ route('admin.add-room') }}" class="btn btn-success mt-4">Aggiungi Nuova Camera</a>

    <!-- Sezione per le prenotazioni -->
    <h2 class="mt-5">Prenotazioni</h2>
    <table class="table table-striped">
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



    <!-- Calendario visivo -->
    <h2 class="mt-5 mb-4">Calendario Prenotazioni</h2>
    <div id="calendar"></div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />

    <script>
        // Grafico di occupazione -> Dati simulati
        var occupazioneDati = [70, 80, 75, 85, 90, 95, 100];
        var entrateDati = [1000, 2000, 1500, 2500, 3000, 3500, 4000];

        var ctx1 = document.getElementById('occupazioneGrafico').getContext('2d');
        var occupazioneGrafico = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab', 'Dom'],
                datasets: [{
                    label: 'Occupazione %',
                    data: occupazioneDati,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            }
        });

        // Grafico di entrate economiche  -> Dati simulati
        var ctx2 = document.getElementById('entrateGrafico').getContext('2d');
        var entrateGrafico = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab', 'Dom'],
                datasets: [{
                    label: 'Entrate (€)',
                    data: entrateDati,
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            }
        });

        // Calendario prenotazioni
        // FullCalendar è usato per visualizzare le prenotazioni in un calendario.

        var bookings = @json($bookings); //bookings viene passato come JSON

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: bookings.map(booking => ({
                    title: 'occupata', // Imposta un titolo fisso per tutte le prenotazioni
                    start: booking.data_checkin,
                    end: booking.data_checkout
                }))
            });

            calendar.render();
        });
    </script>

    <!-- Link per tornare alla home del sito -->
    <a href="/" class="btn btn-primary mt-4">Torna alla home</a>
</div>



@endsection