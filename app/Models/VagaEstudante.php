<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VagaEstudante extends Model
{
    use HasFactory;


    protected $table = 'vagas_estudantes';

    protected $fillable = ["vaga_id", "usuario_estudante_id"];
}
