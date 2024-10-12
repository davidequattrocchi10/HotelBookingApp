<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'nome_cliente' => 'Mario Rossi',
            'valutazione' => 5,
            'commento' => 'Esperienza fantastica! Hotel molto pulito e staff gentilissimo.'
        ]);

        Review::create([
            'nome_cliente' => 'Laura Bianchi',
            'valutazione' => 4,
            'commento' => 'Ottima posizione e camere confortevoli. Lo consiglio!'
        ]);

        // Aggiungi altre recensioni fittizie se necessario
    }
}
