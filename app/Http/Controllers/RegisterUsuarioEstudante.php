<?php

namespace App\Http\Controllers;


use App\Http\Requests\UsuarioEstudanteFormRequest;
use App\Models\CurriculoEstudante;
use App\Models\UsuarioEstudante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterUsuarioEstudante extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UsuarioEstudanteFormRequest $request): JsonResponse
    {

        if ($request->hasFile('curriculo')) {

            $imagePath = $request->file('curriculo')->store('curriculos', 'public');

            $data['curriculo_url'] = $imagePath;
        }


        $usuarioEstudante = UsuarioEstudante::create($request->validated());

        CurriculoEstudante::create([
            'curriculo_url' => $data['curriculo_url'],
            'usuario_estudante_id' => $usuarioEstudante->id,
        ]);
        $token = Auth::guard('estudante')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json(
            ["usuario" => $usuarioEstudante, "token" => $token],
        );
    }
}
