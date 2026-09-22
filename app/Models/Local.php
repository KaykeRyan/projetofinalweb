<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'local';

    protected $fillable = [
        'usuario_id',
        'bloco_id',
        'tipo_local_id',
        'nome',
        'identificador',
        'ativo',
    ];

    public function bloco()
    {
        return $this->belongsTo(Bloco::class, 'bloco_id');
    }

    public function tipoLocal()
    {
        return $this->belongsTo(TipoLocal::class, 'tipo_local_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}