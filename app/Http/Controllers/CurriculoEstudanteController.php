<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurriculoEstudanteFormRequest;
use App\Models\CurriculoEstudante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CurriculoEstudanteController extends Controller
{
    public function showByEstudanteAutenticado(): JsonResponse
    {
        $estudanteId = Auth::guard('estudante')->user()->id;
        $formacoes = CurriculoEstudante::where('usuario_estudante_id', $estudanteId)->get();

        return response()->json($formacoes, 200);
    }




    public function store(CurriculoEstudanteFormRequest $request)
    {
        $data = $request->validated();


        if ($request->hasFile('curriculo')) {

            $imagePath = $request->file('curriculo')->store('curriculos', 'public');

            $data['curriculo_url'] = $imagePath;
        }

        $estudanteId = Auth::guard('estudante')->user()->id;
        CurriculoEstudante::create([
            'curriculo_url' => $data['curriculo_url'],
            'usuario_estudante_id' => $estudanteId,
        ]);


        // Retorna uma resposta JSON com os dados da empresa criada
        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CurriculoEstudante $curriculoEstudante)
    {
        return response()->json($curriculoEstudante, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CurriculoEstudanteFormRequest $request)
    {
        
        $data = $request->validated();

        $estudanteId = Auth::guard('estudante')->user()->id;
        $curriculoEstudante = CurriculoEstudante::where('usuario_estudante_id', $estudanteId)->first();

        if ($curriculoEstudante && $curriculoEstudante->curriculo_url) {
            // Verifica se o arquivo existe no storage e exclui
            Storage::disk('public')->delete($curriculoEstudante->curriculo_url);
        }

        if ($request->hasFile('curriculo')) {
            $imagePath = $request->file('curriculo')->store('curriculos', 'public');
            $data['curriculo_url'] = $imagePath;
        }

        // Atualiza o registro do currículo
        $curriculoEstudante->update([
            'curriculo_url' => $data['curriculo_url'],
        ]);

        // Retorna uma resposta JSON com os dados do currículo atualizado
        return response()->json($curriculoEstudante, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $estudanteId = Auth::guard('estudante')->user()->id;
        $curriculoEstudante = CurriculoEstudante::where('usuario_estudante_id', $estudanteId)->first();

        if ($curriculoEstudante && $curriculoEstudante->curriculo_url) {
            // Verifica se o arquivo existe no storage e exclui
            Storage::disk('public')->delete($curriculoEstudante->curriculo_url);
        }

        // Exclui o registro do currículo
        $curriculoEstudante->delete();

        // Retorna uma resposta JSON com a mensagem de sucesso
        return response()->json([], 204);
    }
}
