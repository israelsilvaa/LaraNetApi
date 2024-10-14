<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioEstudanteUpdateFormRequest;
use App\Models\CurriculoEstudante;
use App\Models\UsuarioEstudante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateUsuarioEstudanteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UsuarioEstudanteUpdateFormRequest $request)
    {
        $data = $request->validated();



        $estudanteId = Auth::guard('estudante')->user()->id;

        if ($request->hasFile('curriculo')) {
            $imagePath = $request->file('curriculo')->store('curriculos', 'public');

            $curriculoEstudante = CurriculoEstudante::where('usuario_estudante_id', $estudanteId)->first();

            if ($curriculoEstudante && $curriculoEstudante->curriculo_url) {
                // Verifica se o arquivo existe no storage e exclui
                Storage::disk('public')->delete($curriculoEstudante->curriculo_url);
            }

            $curriculoEstudante->update([
                'curriculo_url' => $imagePath,
            ]);
        }
        $usuarioEstudante = UsuarioEstudante::find($estudanteId);

        $usuarioEstudante->update($data);

        return response()->json([$usuarioEstudante], 200);

    }
}
