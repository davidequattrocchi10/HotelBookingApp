<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'nome', 'email', 'data_checkin', 'data_checkout'];

    // Definisce che una prenotazione appartiene a una camera
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
