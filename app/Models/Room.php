<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descrizione', 'prezzo', 'disponibile', 'immagine'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
