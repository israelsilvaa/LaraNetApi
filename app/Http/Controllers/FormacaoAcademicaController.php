<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormacaoAcademicaFormRequest;
use App\Models\FormacaoAcademica;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormacaoAcademicaController extends Controller
{

    public function getByEstudanteAutenticado(): JsonResponse
    {
        $estudanteId = Auth::guard('estudante')->user()->id;
        $formacoes = FormacaoAcademica::where('usuario_estudante_id', $estudanteId)->get();

        return response()->json($formacoes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormacaoAcademicaFormRequest $request): JsonResponse
    {
        $dados = $request->validated();
        $estudanteId = Auth::guard('estudante')->user()->id;
        $dados['usuario_estudante_id'] = $estudanteId;
        $formacaoAcademica = FormacaoAcademica::create($dados);

        return response()->json([$formacaoAcademica], 201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(FormacaoAcademicaFormRequest $request, FormacaoAcademica $formacaoAcademica)
    {
        $dados = $request->validated();

        $formacaoAcademica->update($dados);

        return response()->json($formacaoAcademica, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormacaoAcademica $formacaoAcademica): JsonResponse
    {
        $formacaoAcademica->delete();
        
        return response()->json([], 204);
    }
}
