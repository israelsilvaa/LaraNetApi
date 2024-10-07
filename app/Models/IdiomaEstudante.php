<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdiomaEstudante extends Model
{
    use HasFactory;


    protected $table = "idiomas_estudantes";

    protected $fillable = ["idioma_id", "usuario_estudante_id", "nivel"];


    protected $with = ["idioma"];

    public function idioma(): BelongsTo
    {

        return $this->belongsTo(Idioma::class);
    }

    public function estudante(): BelongsTo
    {

        return $this->belongsTo(UsuarioEstudante::class, "usuario_estudante_id");
    }
}
