<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioEmpresaFormRequest;
use App\Http\Requests\UsuarioEstudanteFormRequest;
use App\Models\UsuarioEmpresa;
use App\Models\UsuarioEstudante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RegisterUsuarioEmpresa extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UsuarioEmpresaFormRequest $request): JsonResponse
    {

        $data = $request->validated();


        if ($request->hasFile('image_logo')) {

            $imagePath = $request->file('image_logo')->store('logos', 'public');

            $data['image_logo_url'] = $imagePath;
        }

        // Cria o registro no banco de dados
        $usuarioEmpresa = UsuarioEmpresa::create($data);

        $token = Auth::guard('empresa')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Retorna uma resposta JSON com os dados da empresa criada
        return response()->json(["usuario" => $usuarioEmpresa, "token" => $token]);
    }
}
