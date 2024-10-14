<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsuarioEstudante extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "usuarios_estudantes";
    protected $fillable = [
        'nome',
        'sobrenome',
        'data_nascimento',
        'email',
        'password',
        'cpf'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['curriculo_url'];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

    public function formacoesAcademicas(): HasMany
    {
        return $this->hasMany(FormacaoAcademica::class, 'usuario_estudante_id');

    }

    public function idiomas(): BelongsToMany
    {

        return $this->belongsToMany(Idioma::class, 'idiomas_estudantes', 'usuario_estudante_id', 'idioma_id')->withPivot('nivel');
    }

    public function curriculo(): HasOne
    {  
        return $this->hasOne(CurriculoEstudante::class, 'usuario_estudante_id');
    }

    public function getCurriculoUrlAttribute(): mixed
    {
        $baseUrl = config('app.url'); // Obtém a URL base do projeto a partir do arquivo de configuração
        return $this->curriculo ? $baseUrl . '/storage/' . $this->curriculo->curriculo_url : null;
    }
}
