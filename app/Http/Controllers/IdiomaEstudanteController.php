<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdiomaEstudanteFormRequest;
use App\Models\IdiomaEstudante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdiomaEstudanteController extends Controller
{




    /**
     * Store a newly created resource in storage.
     */
    public function store(IdiomaEstudanteFormRequest $request): JsonResponse
    {
        $dados = $request->validated();
        $dados['usuario_estudante_id'] = Auth::guard('estudante')->user()->id;
        $idiomaEstudante = IdiomaEstudante::create($dados);

        return response()->json($idiomaEstudante, 201);
    }

    /**
     * Display the specified resource.
     */
    public function showByEstudanteAutenticado(): JsonResponse
    {


       $usuarioEstudanteId = Auth::guard('estudante')->user()->id;

        $idiomas = IdiomaEstudante::where('usuario_estudante_id', $usuarioEstudanteId)->get();

        return response()->json($idiomas, 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(IdiomaEstudanteFormRequest $request, IdiomaEstudante $idiomaEstudante): JsonResponse
    {
        $dados = $request->validated();
        $dados['usuario_estudante_id'] = Auth::guard('estudante')->user()->id;
        $idiomaEstudante->update($dados);

        return response()->json($idiomaEstudante, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IdiomaEstudante $idiomaEstudante): JsonResponse
    {
        $idiomaEstudante->delete();

        return response()->json([], 204);
    }
}
