<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Mail\PrenotazioneConfermata;
use Illuminate\Support\Facades\Mail;
use App\Notifications\BookingUpdated;
use App\Notifications\BookingCancelled;

class BookingController extends Controller
{
    // Metodo per salvare una nuova prenotazione
    public function store(Request $request)
    {

        // Validazione dei dati
        $request->validate([
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


        // Creazione della prenotazione associata all'utente loggato
        $booking = Booking::create([
            'room_id' => $request->room_id,
            'user_id' => auth()->id(), // Associa la prenotazione all'utente loggato
            'data_checkin' => $request->data_checkin,
            'data_checkout' => $request->data_checkout,
        ]);



        // Invio dell'email di conferma all'utente loggato
        Mail::to(auth()->user()->email)->send(new PrenotazioneConfermata($booking));

        return redirect('/')->with('success', 'Prenotazione completata con successo! Ti abbiamo inviato un\'email di conferma.');
    }


    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        // Controlla se la prenotazione può essere modificata (5 giorni prima del check-in)
        if (now()->diffInDays($booking->data_checkin, false) < 5) {
            return redirect()->back()->with('error', 'Non puoi modificare questa prenotazione a meno di 5 giorni dal check-in.');
        }

        return view('booking.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Controlla se la prenotazione può essere modificata
        if (now()->diffInDays($booking->data_checkin, false) < 5) {
            return redirect()->back()->with('error', 'Non puoi modificare questa prenotazione a meno di 5 giorni dal check-in.');
        }

        // Aggiorna i dettagli della prenotazione
        $booking->update($request->all());

        // Invia notifica di aggiornamento
        $booking->notify(new BookingUpdated($booking));

        return redirect()->route('dashboard')->with('success', 'Prenotazione aggiornata con successo!');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        // Controlla se la prenotazione può essere cancellata
        if (now()->diffInDays($booking->data_checkin, false) < 5) {
            return redirect()->back()->with('error', 'Non puoi cancellare questa prenotazione a meno di 5 giorni dal check-in.');
        }

        // Recupera l'utente che ha effettuato la prenotazione
        $user = auth()->user();

        // Elimina la prenotazione
        $booking->delete();

        // Invia notifica di cancellazione all'utente
        $user->notify(new BookingCancelled($booking));

        return redirect()->route('user.bookings')->with('success', 'Prenotazione cancellata con successo!');
    }

    public function userBookings()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Devi effettuare il login per vedere le tue prenotazioni.');
        }

        $bookings = Booking::where('user_id', auth()->id())->get();

        return view('user.bookings', compact('bookings'));
    }
}
