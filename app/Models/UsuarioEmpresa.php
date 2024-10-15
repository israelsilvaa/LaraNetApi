<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsuarioEmpresa extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "usuarios_empresas";
    protected $fillable = [
        'nome',
        'razao_social',
        'porte',
        'descricao',
        'cnpj',
        'email',
        'password',
        'image_logo_url'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['logo_full_url'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getLogoFullUrlAttribute(): string
    {
        $baseUrl = config('app.url'); // Obtém a URL base do projeto a partir do arquivo de configuração
        return $baseUrl . '/storage/' . $this->image_logo_url;
    }
}
