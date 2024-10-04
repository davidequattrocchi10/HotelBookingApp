<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Log;

class BotManController extends Controller
{
    public function handle()
    {
        // Log::info('Entrando nel metodo handle del BotManController');
        $botman = resolve('botman');
        require base_path('routes/botman.php'); // Include il file botman.php per caricare le risposte

        // Log::info('Il file botman.php è stato caricato.');
        $botman->listen();
    }
}
