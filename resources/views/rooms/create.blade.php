@extends('layouts.user-layout')

@section('content')


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



<!-- Section Prenotazione  -->
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


<!-- Sezione di Recensioni e Upselling -->
<div class="bg-gray-100 py-12">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-8 text-center">Recensioni dei Nostri Ospiti</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="review-card bg-white shadow-md rounded-lg p-4 mb-6">
                    <p class="text-gray-700 mb-4">"Un'esperienza indimenticabile! Camere pulite e servizio impeccabile."</p>
                    <h5 class="font-semibold text-gray-900">- Marco Rossi</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="review-card bg-white shadow-md rounded-lg p-4 mb-6">
                    <p class="text-gray-700 mb-4">"Posizione perfetta e comfort eccellente. Torneremo sicuramente."</p>
                    <h5 class="font-semibold text-gray-900">- Laura Bianchi</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="review-card bg-white shadow-md rounded-lg p-4 mb-6">
                    <p class="text-gray-700 mb-4">"Colazione deliziosa e vista mozzafiato dalla nostra camera."</p>
                    <h5 class="font-semibold text-gray-900">- Giovanni Verdi</h5>
                </div>
            </div>
        </div>

        <!-- Sezione Upselling -->
        <h2 class="text-3xl font-bold mt-10 mb-8 text-center">Servizi Extra per un Soggiorno Perfetto</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="flex justify-center mb-4">
                    <img src="https://via.placeholder.com/200" alt="Colazione in Camera" class="mb-4">
                </div>
                <h4 class="text-xl font-bold">Colazione in Camera</h4>
                <p class="text-gray-600">Solo €20 in più per iniziare la giornata nel massimo comfort.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="flex justify-center mb-4">
                    <img src="https://via.placeholder.com/200" alt="Spa e Benessere" class="mb-4">
                </div>
                <h4 class="text-xl font-bold">Accesso alla Spa</h4>
                <p class="text-gray-600">Rilassati nella nostra spa con sauna e idromassaggio.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="flex justify-center mb-4">
                    <img src="https://via.placeholder.com/200" alt="Servizio Navetta" class="mb-4">
                </div>
                <h4 class="text-xl font-bold">Servizio Navetta</h4>
                <p class="text-gray-600">Navetta gratuita per l'aeroporto e principali attrazioni turistiche.</p>
            </div>
        </div>
    </div>
</div>


<!-- Section Camere -->
<div id="camere" class="container mt-5">
    <h2 class="text-3xl font-bold mb-8 text-center">Le nostre camere</h2>
    <div class="row">
        @foreach ($rooms->take(6) as $room) <!-- Mostra solo le prime 6 camere -->
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
    <!-- Bottone per visualizzare tutte le camere -->
    <div class="text-center mt-5">
        <a href="{{ route('rooms.camere') }}" class="btn btn-secondary">Visualizza tutte le camere</a>
    </div>
</div>

<!-- Icona del chatbot -->
<div id="chatbot-icon">
    <img src="https://pbs.twimg.com/profile_images/1795851438956204032/rLl5Y48q_400x400.jpg" alt="Chatbot" id="chatbot-image" style="width: 60px; height: 60px;">
</div>

<!-- Finestra del chatbot -->
<div id="chatbot-window" style="display: none;">
    <div id="chatbot-header">Un AI tutta per te</div>
    <div id="chatbot-messages"></div>
    <div id="chatbot-input">
        <input type="text" id="chatbot-user-message" placeholder="Scrivi qualcosa...">
        <button id="chatbot-submit">Invia</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostra/Nasconde la finestra del chatbot quando si clicca sull'icona
        document.getElementById('chatbot-icon').addEventListener('click', function() {
            var chatbotWindow = document.getElementById('chatbot-window');
            chatbotWindow.style.display = (chatbotWindow.style.display === 'none' || chatbotWindow.style.display === '') ? 'block' : 'none';
        });

        // Invia il messaggio al chatbot quando si clicca su "Invia" o si preme 'Enter'
        function sendMessage() {
            let userMessage = document.getElementById('chatbot-user-message').value;
            if (userMessage.trim() !== '') {
                // Mostra il messaggio dell'utente
                document.getElementById('chatbot-messages').innerHTML += `<div><strong>Utente:</strong> ${userMessage}</div>`;

                axios.post('/botman/chat', {
                    driver: 'web',
                    message: userMessage
                }).then(function(response) {
                    // Mostra la risposta del bot
                    const botReply = response.data.messages[0].text; // Correzione per leggere il testo corretto
                    document.getElementById('chatbot-messages').innerHTML += `<div><strong>Bot:</strong> ${botReply}</div>`;
                    document.getElementById('chatbot-user-message').value = '';
                }).catch(function(error) {
                    console.error('Errore:', error);
                });
            }
        }

        // Invia messaggio cliccando su "Invia"
        document.getElementById('chatbot-submit').addEventListener('click', function() {
            sendMessage();
        });

        // Invia messaggio premendo 'Enter'
        document.getElementById('chatbot-user-message').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Previene il comportamento predefinito di invio del form
                sendMessage();
            }
        });
    });
</script>



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

@endsection