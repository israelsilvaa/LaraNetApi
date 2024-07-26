<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'idade', 'user_id ', 'curso_id '];

}
