<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'tipo_estagio', 'turno', 'valor', 'usuario_empresa_id'];
    protected $with = ['cursos'];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'vagas_cursos', 'vaga_id', 'curso_id');
    }
}
