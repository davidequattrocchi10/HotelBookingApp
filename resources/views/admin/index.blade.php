@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold mb-6">Pannello di Amministrazione</h1>

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

    <!-- Link per tornare alla home del sito -->
    <a href="/" class="btn btn-primary mt-4">Torna alla home</a>
</div>
@endsection