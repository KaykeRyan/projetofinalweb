<?php

namespace Database\Seeders;

use App\Models\Bloco;
use App\Models\TipoLocal;
use Illuminate\Database\Seeder;

class EstruturaEscolaSeeder extends Seeder
{
    public function run(): void
    {
        $blocos = [
            ['nome' => 'Bloco 1', 'descricao' => 'Cantina'],
            ['nome' => 'Bloco 2', 'descricao' => 'Ensino Fundamental'],
            ['nome' => 'Bloco 3', 'descricao' => 'Ensino Médio'],
            ['nome' => 'Bloco 4', 'descricao' => 'Laboratório, Informática e SENAI'],
        ];

        foreach ($blocos as $bloco) {
            Bloco::firstOrCreate(['nome' => $bloco['nome']], $bloco);
        }

        $tipos = [
            'Cantina',
            'Sala de Aula',
            'Laboratório',
            'Sala de Informática',
            'Sala SENAI',
        ];

        foreach ($tipos as $nome) {
            TipoLocal::firstOrCreate(['nome' => $nome]);
        }
    }
}