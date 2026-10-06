<?php

namespace Database\Seeders;

use App\Models\TipoLocal;
use Illuminate\Database\Seeder;

class TipoLocalSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            'Sala de Aula',
            'Direção',
            'Secretaria',
            'Coordenação',
            'Sala dos Monitores',
            'Cantina',
        ];

        foreach ($tipos as $nome) {
            TipoLocal::firstOrCreate(['nome' => $nome]);
        }
    }
}