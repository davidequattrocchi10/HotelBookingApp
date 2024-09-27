<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home page')</title>
    <!-- Include il CSS di Bootstrap e altri -->
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
                <li><a href="{{ route('user.bookings') }}" class="text-gray-300 hover:text-white">Le mie prenotazioni</a></li>




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

    <!-- Main content -->
    <div>
        @yield('content')
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