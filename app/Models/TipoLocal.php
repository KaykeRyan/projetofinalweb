<?php
// app/Models/TipoLocal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoLocal extends Model
{
    protected $table = 'tipo_local';

    protected $fillable = [
        'nome',
    ];
}