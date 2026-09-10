<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenUsuario extends Model
{
    protected $table = 'token_usuario';

    protected $fillable = [
        'usuario_id',
        'token',
        'valido_ate',
    ];

    protected $casts = [
        'valido_ate' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
