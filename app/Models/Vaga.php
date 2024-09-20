<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'tipo_estagio', 'turno', 'valor', 'usuario_empresa_id'];
    protected $with = ['cursos', 'empresa'];

    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class, 'vagas_cursos', 'vaga_id', 'curso_id');
    }

    public function empresa(): BelongsTo
    {

        return $this->belongsTo(UsuarioEmpresa::class, 'usuario_empresa_id');
    }

    public function estudantes(): BelongsToMany
    {
        return $this->belongsToMany(UsuarioEstudante::class, 'vagas_estudantes', 'vaga_id', 'usuario_estudante_id');
    }

    public function scopeSearchByEmpresaName(Builder $query, string $nomeEmpresa): Builder
    {

        return $query->whereHas('empresa', function ($query) use ($nomeEmpresa) {
            $query->where('nome', 'like', '%' . $nomeEmpresa . '%');
        });
    }

    public function estudanteEstaEscrito(int $estudanteID){

        return $this->estudantes()->where('usuario_estudante_id', $estudanteID)->exists();
    }
}
