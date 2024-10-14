<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurriculoEstudante extends Model
{
    use HasFactory;

    protected $table = 'curriculos_estudantes';

    protected $fillable = [
        'curriculo_url',
        'usuario_estudante_id',
    ];
    
    public function usuarioEstudante(): BelongsTo
    {
        return $this->belongsTo(UsuarioEstudante::class);
    }


}
