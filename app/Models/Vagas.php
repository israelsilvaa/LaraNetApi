<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vagas extends Model
{
    use HasFactory;
    protected $fillable = ['empresa_id', 'titulo',  'descricao',  'modalidade', 'requisitos'];
}
