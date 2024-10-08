<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConquistaEstudante extends Model
{
    use HasFactory;

    protected $table = "conquistas_estudantes";


    protected $fillable = ["usuario_estudante_id", "tipo", "titulo", "descricao"];

    public function estudante(): BelongsTo
    {
        return $this->belongsTo(UsuarioEstudante::class, "usuario_estudante_id");
    }
}
