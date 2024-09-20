<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $bookings = Booking::with('room')->get();
        return view('admin.index', compact('rooms', 'bookings'));
    }

    // Visualizza tutte le camere
    public function showRooms()
    {
        $rooms = Room::all();
        return view('admin.camere', compact('rooms'));
    }

    // Visualizza tutte le prenotazioni
    public function showBookings()
    {
        $bookings = Booking::with('room')->get();
        return view('admin.prenotazioni', compact('bookings'));
    }

    public function createRoom()
    {
        return view('admin.create-room');
    }

    public function storeRoom(Request $request)
    {
        // Validazione dei dati
        $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'required|string',
            'prezzo' => 'required|numeric',
            'disponibile' => 'required|boolean',
        ]);

        // Creazione della camera
        Room::create([
            'nome' => $request->nome,
            'descrizione' => $request->descrizione,
            'prezzo' => $request->prezzo,
            'disponibile' => $request->disponibile,
        ]);

        return redirect()->route('admin.camere')->with('success', 'Camera aggiunta con successo!');
    }

    public function editRoom($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.edit-room', compact('room'));
    }

    public function updateRoom(Request $request, $id)
    {
        // Validazione dei dati
        $request->validate([
            'nome' => 'required|string|max:255',
            'descrizione' => 'required|string',
            'prezzo' => 'required|numeric',
            'disponibile' => 'required|boolean',
        ]);

        // Trova la camera e aggiorna i dati
        $room = Room::findOrFail($id);
        $room->update([
            'nome' => $request->nome,
            'descrizione' => $request->descrizione,
            'prezzo' => $request->prezzo,
            'disponibile' => $request->disponibile,
        ]);

        return redirect()->route('admin.camere')->with('success', 'Camera modificata con successo!');
    }

    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.camere')->with('success', 'Camera eliminata con successo!');
    }
}
