<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConquistaEstudanteFormRequest;
use App\Models\ConquistaEstudante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConquistaEstudanteController extends Controller
{


    public function showByEstudanteAutenticado(): JsonResponse
    {

        $estudanteId = Auth::guard('estudante')->user()->id;

        $conquistas = ConquistaEstudante::where('usuario_estudante_id', $estudanteId)->get();

        return response()->json($conquistas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConquistaEstudanteFormRequest $request): JsonResponse
    {
        $dados = $request->validated();
        $dados['usuario_estudante_id'] = Auth::guard('estudante')->user()->id;
        $conquistaEstudante = ConquistaEstudante::create($dados);

        return response()->json($conquistaEstudante, 201);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(ConquistaEstudanteFormRequest $request, ConquistaEstudante $conquistaEstudante): JsonResponse
    {
        $dados = $request->validated();
        $dados['usuario_estudante_id'] = Auth::guard('estudante')->user()->id;
        $conquistaEstudante->update($dados);

        return response()->json($conquistaEstudante, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConquistaEstudante $conquistaEstudante): JsonResponse
    {
        $conquistaEstudante->delete();

        return response()->json([], 204);
    }
}
