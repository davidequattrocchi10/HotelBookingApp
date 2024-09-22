<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazioni</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite('resources/css/app.css')


</head>

<body>

    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-white font-bold text-lg">Hotel Booking</a>
            <ul class="flex space-x-4">
                <li><a href="/" class="text-gray-300 hover:text-white">Home</a></li>
                <li><a href="#camere" class="text-gray-300 hover:text-white">Camere</a></li>
                <li><a href="#servizi" class="text-gray-300 hover:text-white">Servizi</a></li>
                <li><a href="#contatti" class="text-gray-300 hover:text-white">Contatti</a></li>

                <!-- Controllo se l'utente è autenticato -->
                @auth
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <li>
                    <a href="#" class="text-gray-300 hover:text-white"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>




                <!-- Se l'utente autenticato è admin, mostra anche il link alla dashboard -->
                @if(auth()->user()->hasRole('admin'))
                <li><a href="/admin" class="text-gray-300 hover:text-white">Dashboard Admin</a></li>
                @endif
                @endauth



                <!-- Mostra Registrati e Login solo se l'utente è ospite -->
                @guest
                <li><a href="/register" class="text-gray-300 hover:text-white">Registrati</a></li>
                <li><a href="/login" class="text-gray-300 hover:text-white">Login</a></li>
                @endguest
            </ul>
        </div>
    </nav>

    <!-- Notifica di successo o errore -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <!-- Hero Section con immagine di un hotel bellissimo -->
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('https://images.unsplash.com/photo-1560347876-aeef00ee58a1?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max');">
        <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Sovrapposizione scura per rendere il testo leggibile -->
        <div class="container mx-auto h-full flex items-center justify-center">
            <div class="text-center text-white z-10">
                <h1 class="text-5xl font-bold mb-4">Benvenuti all'Hotel di Lusso</h1>
                <h2 class="text-xl mb-6">Un'esperienza esclusiva di comfort e stile.</h2>
                <a href="#camere" class="btn btn-primary px-8 py-3 text-lg bg-white text-black font-semibold hover:bg-gray-100">Prenota Ora</a>
            </div>
        </div>
    </section>




    <div class="bg-gray-100 text-gray-900 py-5 mb-5">
        <div class="container">
            <h1 class="text-3xl font-bold mb-3">Prenota la tua stanza</h1>
            <p class="text-lg mb-4">Scegli le date di check-in e check-out per trovare la tua camera perfetta.</p>

            <form action="/" method="GET" class="bg-white p-4 rounded-lg shadow-md">
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="checkin" class="text-gray-700 font-bold">Check-in:</label>
                        <input type="date" id="checkin" name="checkin" class="form-control border border-gray-300 p-2 rounded-lg hover:shadow-md focus:ring-2 focus:ring-blue-500" value="{{ request('checkin') }}">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="checkout" class="text-gray-700 font-bold">Check-out:</label>
                        <input type="date" id="checkout" name="checkout" class="form-control border border-gray-300 p-2 rounded-lg hover:shadow-md focus:ring-2 focus:ring-blue-500" value="{{ request('checkout') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-4 w-full py-2">Cerca</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div id="camere" class="container mt-5">
        <h2 class="text-3xl font-bold mb-8 text-center">Le nostre camere</h2>
        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-md-4 mb-5">
                <div class="card shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="https://via.placeholder.com/400x200" alt="{{ $room->nome }}" class="w-full">
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
                                    <label for="nome" class="block text-gray-700">Nome</label>
                                    <input type="text" name="nome" id="nome" class="form-control w-full pl-10" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="block text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" class="form-control w-full pl-10" required>
                                </div>

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



    <!-- Sezione Descrittiva: Cosa fare nei dintorni -->
    <section class="bg-white py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-8">Scopri il nostro hotel e i dintorni</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h3 class="text-2xl font-semibold mb-3">Il nostro hotel</h3>
                    <p class="text-lg text-gray-700">
                        Situato nel cuore della città, il nostro hotel combina <em>eleganza</em> e <strong>comfort</strong> per offrirti un'esperienza indimenticabile. Le nostre camere sono arredate con <strong>stile contemporaneo</strong>, offrendo una vista mozzafiato sul paesaggio circostante.
                    </p>
                </div>
                <div class="col-md-6 mb-4">
                    <h3 class="text-2xl font-semibold mb-3">Cosa fare nei dintorni</h3>
                    <p class="text-lg text-gray-700">
                        Esplora le meraviglie naturali e culturali nei dintorni del nostro hotel. A pochi passi troverai <em>parchi naturali</em>, <strong>musei</strong> storici e una <em>vibrante vita notturna</em> che ti farà innamorare della nostra città. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae sapien ut lorem vestibulum fermentum.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <div id="contatti" class="container mt-5">
        <h2 class="text-2xl font-bold mb-4 text-center">Contattaci</h2>
        <div class="row">
            <div class="col-md-6">
                <p class="text-lg mb-4">Per qualsiasi domanda, non esitare a contattarci:</p>
                <p class="text-lg"><strong>Email:</strong> info@hotelbooking.com</p>
                <p class="text-lg"><strong>Telefono:</strong> +39 012 3456789</p>
                <p class="text-lg"><strong>Indirizzo:</strong> Via Roma 123, Città, Italia</p>
            </div>
            <div class="col-md-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509384!2d144.9630577153159!3d-37.81421797975161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577f5c6f74fd03!2sFlinders+Street+Station!5e0!3m2!1sit!2sit!4v1631270983321!5m2!1sit!2sit"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>



    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-5">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-bold mb-4">I nostri servizi</h2>
            <ul class="list-none mb-8 text-lg">
                <li>Connessione Wi-Fi gratuita in tutta la struttura</li>
                <li>Colazione inclusa</li>
                <li>Servizio in camera 24 ore su 24</li>
                <li>Piscina esterna con vista panoramica</li>
                <li>Servizio navetta gratuito per l'aeroporto</li>
            </ul>
            <p class="mb-4">&copy; 2024 Hotel di Lusso. Tutti i diritti riservati.</p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="text-gray-400 hover:text-white">Facebook</a>
                <a href="#" class="text-gray-400 hover:text-white">Instagram</a>
                <a href="#" class="text-gray-400 hover:text-white">LinkedIn</a>
            </div>
        </div>
    </footer>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Rimuove l'alert dopo 5 secondi
            setTimeout(function() {
                let alert = document.querySelector('.alert');
                if (alert) {
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 500); // Rimuove l'elemento dopo l'animazione
                }
            }, 5000);
        });
    </script>

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
    @vite('resources/js/app.js')

</body>

</html>