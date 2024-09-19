<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VagaCurso extends Model
{
    use HasFactory;
    protected $table = "vagas_cursos";
    protected $fillable = ['vaga_id', 'curso_id'];
}
