@extends('layouts.user-layout')

@section('content')



<!-- Carousel delle Immagini di Tutte le Camere -->
<div id="roomsCarousel" class="carousel slide mb-5 mt-5" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner" style="max-height: 500px; max-width: 900px; margin: 0 auto;">
        @foreach ($rooms as $index => $room)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <img src="{{ asset('images/' . $room->immagine) }}" alt="{{ $room->nome }}" class="d-block w-100" alt="Immagine di {{ $room->nome }}">
            <div class="carousel-caption d-none d-md-block">
                <h5>{{ $room->nome }}</h5>
                <p>{{ $room->descrizione }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#roomsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#roomsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<!-- Sezione Camere con Galleria Fotografica -->
<div id="camere" class="container mt-5">
    <h2 class="text-3xl font-bold mb-8 text-center">Le nostre camere</h2>
    <div class="row">
        @foreach ($rooms->take(6) as $room) <!-- Mostra solo le prime 6 camere -->
        <div class="col-md-4 mb-5">
            <div class="card shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
                @if ($room->immagine)
                <img src="{{ asset('images/' . $room->immagine) }}" alt="{{ $room->nome }}" class="w-full">
                @else
                <img src="https://via.placeholder.com/400x200" alt="{{ $room->nome }}" class="w-full">
                @endif
                <div class="card-body p-4">
                    <h5 class="card-title text-xl font-semibold">{{ $room->nome }}</h5>
                    <p class="card-text text-gray-600">{{ $room->descrizione }}</p>
                    <p class="card-text text-gray-900 font-bold">Prezzo: €{{ $room->prezzo }}</p>
                    <button type="button" class="btn btn-primary mt-3 w-full" data-bs-toggle="modal" data-bs-target="#bookingModal-{{ $room->id }}">
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
                        <form action="{{ route('prenotazioni.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">

                            <div class="form-group mb-3">
                                <label for="data_checkin" class="block text-gray-700">Check-in</label>
                                <input type="date" name="data_checkin" id="data_checkin" class="form-control w-full" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="data_checkout" class="block text-gray-700">Check-out</label>
                                <input type="date" name="data_checkout" id="data_checkout" class="form-control w-full" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-full mt-3">Conferma Prenotazione</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection