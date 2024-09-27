@extends('layouts.user-layout')

@section('content')
<div class="container">
    <h1>Modifica Prenotazione</h1>
    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="checkin">Check-in:</label>
            <input type="date" name="data_checkin" class="form-control" value="{{ $booking->data_checkin }}" required>
        </div>
        <div class="mb-3">
            <label for="checkout">Check-out:</label>
            <input type="date" name="data_checkout" class="form-control" value="{{ $booking->data_checkout }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Aggiorna Prenotazione</button>
    </form>
</div>
@endsection