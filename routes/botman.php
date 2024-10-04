<?php

use App\Models\Room;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

// Risposta a 'ciao'
$botman->hears('ciao', function (BotMan $bot) {
    $bot->reply('Ciao! Come posso aiutarti?');
});

// Risposta per il numero di camere disponibili
$botman->hears('quante camere (.*)', function (BotMan $bot) {
    $numCamere = Room::count(); // Supponendo che la tabella "rooms" contenga i dati delle camere
    $bot->reply("Abbiamo attualmente $numCamere camere disponibili.");
});

// Risposta per il prezzo delle stanze
$botman->hears('qual è il prezzo delle stanze', function (BotMan $bot) {
    $prezzoMedio = Room::average('prezzo'); // Supponendo che la tabella "rooms" abbia un campo "prezzo"
    $bot->reply("Il prezzo medio delle nostre stanze è di €$prezzoMedio a notte.");
});

// Risposta di fallback per messaggi sconosciuti
$botman->fallback(function (BotMan $bot) {
    $bot->reply("Mi dispiace, non ho capito la tua richiesta. Puoi ripetere?");
});
