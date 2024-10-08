<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabilidadeEstudanteFormRequest;
use App\Models\HabilidadeEstudante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabilidadeEstudanteController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(HabilidadeEstudanteFormRequest $request)
    {
        $dados = $request->validated();
        $dados['usuario_estudante_id'] = Auth::guard('estudante')->user()->id;
        $habilidadeEstudante = HabilidadeEstudante::create($dados);

        return response()->json($habilidadeEstudante, 201);
    }

    public function showByEstudanteAutenticado()
    {

        $esudanteId = Auth::guard('estudante')->user()->id;

        $habilidades = HabilidadeEstudante::where('usuario_estudante_id', $esudanteId)->get();

        return response()->json($habilidades, 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(HabilidadeEstudanteFormRequest $request, HabilidadeEstudante $habilidadeEstudante)
    {
        $dados = $request->validated();
        $dados['usuario_estudante_id'] = Auth::guard('estudante')->user()->id;
        $habilidadeEstudante->update($dados);

        return response()->json($habilidadeEstudante, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HabilidadeEstudante $habilidadeEstudante)
    {
        $habilidadeEstudante->delete();

        return response()->json([], 204);
    }
}
