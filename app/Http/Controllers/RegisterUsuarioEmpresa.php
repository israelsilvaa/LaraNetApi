<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioEmpresaFormRequest;
use App\Http\Requests\UsuarioEstudanteFormRequest;
use App\Models\UsuarioEmpresa;
use App\Models\UsuarioEstudante;
use Illuminate\Http\Request;

class RegisterUsuarioEmpresa extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UsuarioEmpresaFormRequest $request)
    {


        $data = $request->validated();

       
        if ($request->hasFile('image_logo')) {
            
            $imagePath = $request->file('image_logo')->store('logos', 'public');
            
            $data['image_logo_url'] = $imagePath;
        }

        // Cria o registro no banco de dados
        $usuarioEmpresa = UsuarioEmpresa::create($data);

        // Retorna uma resposta JSON com os dados da empresa criada
        return response()->json($usuarioEmpresa);
    }
}
