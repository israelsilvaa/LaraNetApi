<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormacaoAcademica extends Model
{
    use HasFactory;

    protected $table = "formacoes_academicas";

    protected $casts = [
        "data_inicio" => "date",
        "data_fim" => "date",
    ];

    protected $with = ["curso"];
    protected $fillable = ["tipo_grau", "status", "curso_id", "usuario_estudante_id", "instituicao_nome", "data_inicio", "data_fim"];

    public function curso(): BelongsTo
    {

        return $this->belongsTo(Curso::class);
    }

    public function estudante(): BelongsTo
    {

        return $this->belongsTo(UsuarioEstudante::class, "usuario_estudante_id");
    }
}
