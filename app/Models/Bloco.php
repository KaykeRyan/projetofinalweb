<?php
// app/Models/Bloco.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloco extends Model
{
    protected $table = 'bloco';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function locais()
    {
        return $this->hasMany(Local::class, 'bloco_id');
    }
}