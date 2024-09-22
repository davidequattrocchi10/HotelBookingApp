<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Mail\PrenotazioneConfermata;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    // Metodo per salvare una nuova prenotazione
    public function store(Request $request)
    {
        // Validazione dei dati
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'data_checkin' => 'required|date|after_or_equal:today',
            'data_checkout' => 'required|date|after:data_checkin',
            'room_id' => 'required|exists:rooms,id',
        ]);

        // Verifica della disponibilità della camera nelle date selezionate
        $room = Room::find($request->room_id);
        $isAvailable = Booking::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('data_checkin', [$request->data_checkin, $request->data_checkout])
                    ->orWhereBetween('data_checkout', [$request->data_checkin, $request->data_checkout]);
            })->doesntExist();

        if (!$isAvailable) {
            return redirect()->back()->with('error', 'La camera non è disponibile per le date selezionate.');
        }

        // Creazione della prenotazione se disponibile
        $booking =  Booking::create([
            'room_id' => $request->room_id,
            'nome' => $request->nome,
            'email' => $request->email,
            'data_checkin' => $request->data_checkin,
            'data_checkout' => $request->data_checkout,
        ]);

        // Invio dell'email di conferma
        Mail::to($booking->email)->send(new PrenotazioneConfermata($booking));

        return redirect('/')->with('success', 'Prenotazione completata con successo! Ti abbiamo inviato un\'email di conferma.');
    }
}
