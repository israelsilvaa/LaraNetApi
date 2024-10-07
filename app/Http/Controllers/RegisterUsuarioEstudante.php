<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioEstudanteFormRequest;
use App\Models\UsuarioEstudante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterUsuarioEstudante extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UsuarioEstudanteFormRequest $request): JsonResponse
    {


        $usuarioEstudante = UsuarioEstudante::create($request->validated());


        return response()->json($usuarioEstudante);
    }
}
