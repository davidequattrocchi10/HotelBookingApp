@extends('layouts.user-layout')

@section('content')
<div class="container mt-5">
    <h1>Le mie prenotazioni</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Camera</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->room->nome }}</td>
                <td>{{ $booking->data_checkin }}</td>
                <td>{{ $booking->data_checkout }}</td>
                <td>
                    @if(now()->diffInDays($booking->data_checkin, false) >= 5)
                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cancella</button>
                    </form>
                    @else
                    <span class="text-muted">Non modificabile</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection