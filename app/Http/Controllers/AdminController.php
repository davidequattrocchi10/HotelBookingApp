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
        return view('admin.dashboard', compact('rooms', 'bookings'));
    }
}
