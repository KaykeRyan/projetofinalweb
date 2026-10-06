<?php

namespace Database\Seeders;

use App\Models\Bloco;
use Illuminate\Database\Seeder;

class BlocoTipoSeeder extends Seeder
{
    public function run(): void
    {
        $blocos = [
            ['nome' => 'Bloco 1', 'descricao' => 'Direção e Secretaria'],
            ['nome' => 'Bloco 2', 'descricao' => 'Sala dos Monitores e Coordenação'],
            ['nome' => 'Bloco 3', 'descricao' => 'Salas de Aula'],
            ['nome' => 'Bloco 4', 'descricao' => 'Salas de Aula'],
            ['nome' => 'Cantina', 'descricao' => 'Área da Cantina'],
        ];

        foreach ($blocos as $bloco) {
            Bloco::firstOrCreate(['nome' => $bloco['nome']], $bloco);
        }
    }
}