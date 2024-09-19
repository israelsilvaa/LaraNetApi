<?php

namespace App\Policies;


use App\Models\UsuarioEmpresa;
use App\Models\Vaga;
use Illuminate\Auth\Access\Response;

class VagaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function update(UsuarioEmpresa $user, Vaga $vaga)
    {   
        // Permitir se o usuario_empresa autenticado for o dono da vaga
        return $user->id === $vaga->usuario_empresa_id;
    }

    /**
     * Determine if the authenticated usuario_empresa can delete the given vaga.
     */
    public function delete(UsuarioEmpresa $user, Vaga $vaga)
    {
        // Permitir se o usuario_empresa autenticado for o dono da vaga
        return $user->id === $vaga->usuario_empresa_id;
    }
}
