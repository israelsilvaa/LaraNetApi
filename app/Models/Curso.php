<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];


    
    public function vagas()
    {
        return $this->belongsToMany(Vaga::class, 'vagas_cursos', 'curso_id', 'vaga_id');
    }
}
