<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Booking;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

        if ($checkin && $checkout) {
            // Filtra le camere che non hanno prenotazioni nelle date selezionate
            $rooms = Room::whereDoesntHave('bookings', function ($query) use ($checkin, $checkout) {
                $query->whereBetween('data_checkin', [$checkin, $checkout])
                    ->orWhereBetween('data_checkout', [$checkin, $checkout]);
            })->get();
        } else {
            // Se non ci sono date selezionate, mostra tutte le camere
            $rooms = Room::all();
        }

        return view('rooms.create', compact('rooms'));
    }



    public function store(Request $request)
    {
        // Validazione del form di prenotazione
        $validated = $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'data_checkin' => 'required|date',
            'data_checkout' => 'required|date|after:data_checkin',
            'room_id' => 'required|exists:rooms,id',
        ]);

        // Verifica della disponibilità della camera nelle date selezionate
        $isAvailable = Booking::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('data_checkin', [$request->data_checkin, $request->data_checkout])
                    ->orWhereBetween('data_checkout', [$request->data_checkin, $request->data_checkout]);
            })->doesntExist();

        if (!$isAvailable) {
            return redirect()->back()->with('error', 'La camera non è disponibile per le date selezionate.');
        }

        // Creazione della prenotazione se la camera è disponibile
        Booking::create($validated);

        return redirect('/')->with('success', 'Prenotazione completata con successo!');
    }
}
