@extends('layouts.app')

@section('title', 'Gestione Prenotazioni')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold mb-6">Gestione Prenotazioni</h1>
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
            @foreach($bookings as $booking)
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

    <!-- Link per tornare alla dashboard e alla home -->
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-4">Torna alla Dashboard di Amministrazione</a>
    <a href="/" class="btn btn-primary mt-4">Torna alla home</a>
</div>
@endsection