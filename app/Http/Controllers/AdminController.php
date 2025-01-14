<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Review;


class AdminController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $bookings = Booking::with('room')->get();
        $prenotazioni = Booking::all(); # per l'occupazione delle camere

        // return view('admin.index', compact('rooms', 'bookings'));



        // Calcolo dell'occupazione in percentuale
        $totalRooms = $rooms->count();
        $occupiedRooms = Booking::distinct('room_id')->count('room_id');
        $occupazione = ($totalRooms > 0) ? ($occupiedRooms / $totalRooms) * 100 : 0;

        // Numero di recensioni
        $recensioni_totali = Review::count(); // Se hai una tabella "reviews"

        // Calcolo delle entrate totali
        $entrate_totali = $totalRooms * 100; // Ogni prenotazione genera 100€ (non c'è 'prezzo' nel database è una prova)

        // Passaggio delle variabili alla view
        return view('admin.index', compact('rooms', 'bookings', 'prenotazioni', 'occupazione', 'recensioni_totali', 'entrate_totali'));
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
            'immagine' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Aggiunta della validazione per l'immagine
        ]);

        // Gestione del caricamento dell'immagine
        $imageName = null;
        if ($request->hasFile('immagine')) {
            $imageName = time() . '.' . $request->immagine->extension();
            $request->immagine->move(public_path('images'), $imageName); // Salva l'immagine nella cartella 'public/images'
        }


        // Creazione della camera
        Room::create([
            'nome' => $request->nome,
            'descrizione' => $request->descrizione,
            'prezzo' => $request->prezzo,
            'disponibile' => $request->disponibile,
            'immagine' => $imageName // Salva il nome dell'immagine se è stata caricata
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
            'immagine' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validazione per l'immagine
        ]);

        // Trova la camera e aggiorna i dati
        $room = Room::findOrFail($id);

        // Se è stata caricata una nuova immagine
        if ($request->hasFile('immagine')) {
            // Cancella l'immagine precedente se esiste
            if ($room->immagine && file_exists(public_path('images/' . $room->immagine))) {
                unlink(public_path('images/' . $room->immagine)); // Cancella il vecchio file immagine
            }

            // Carica la nuova immagine
            $imageName = time() . '.' . $request->immagine->extension();
            $request->immagine->move(public_path('images'), $imageName);
        } else {
            // Mantiene l'immagine esistente se non viene caricata una nuova immagine
            $imageName = $room->immagine;
        }

        $room->update([
            'nome' => $request->nome,
            'descrizione' => $request->descrizione,
            'prezzo' => $request->prezzo,
            'disponibile' => $request->disponibile,
            'immagine' => $imageName
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
