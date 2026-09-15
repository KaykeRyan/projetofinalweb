<?php
// database/seeders/EstruturaEscolaSeeder.php

namespace Database\Seeders;

use App\Models\Bloco;
use App\Models\TipoLocal;
use Illuminate\Database\Seeder;

class EstruturaEscolaSeeder extends Seeder
{
    public function run(): void
    {
        Bloco::insert([
            ['nome' => 'Bloco 1', 'descricao' => 'Cantina', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bloco 2', 'descricao' => 'Ensino Fundamental', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bloco 3', 'descricao' => 'Ensino Médio', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bloco 4', 'descricao' => 'Laboratório, Informática e SENAI', 'created_at' => now(), 'updated_at' => now()],
        ]);

        TipoLocal::insert([
            ['nome' => 'Cantina', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sala de Aula', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Laboratório', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sala de Informática', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sala SENAI', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}