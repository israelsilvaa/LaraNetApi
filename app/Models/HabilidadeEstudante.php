<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HabilidadeEstudante extends Model
{
    use HasFactory;

    protected $table = "habilidades_estudantes";

    protected $fillable = ["usuario_estudante_id", "nome"];

    public function estudante(): BelongsTo
    {
        return $this->belongsTo(UsuarioEstudante::class, "usuario_estudante_id");
    }
}
