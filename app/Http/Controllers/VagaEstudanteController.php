<?php

namespace App\Http\Controllers;

use App\Models\UsuarioEmpresa;
use App\Models\UsuarioEstudante;
use App\Models\Vaga;
use App\Models\VagaEstudante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VagaEstudanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function showVagasByEstudanteAuth(): JsonResponse
     {
        $vagasEstudanteID = Auth::guard('estudante')->user()->vagas->pluck('vaga_id');
        
        $vagas = Vaga::whereIn('id', $vagasEstudanteID)->paginate(10);
         return response()->json($vagas);
     }
    public function inscreverEstudanteVaga(Vaga $vaga): JsonResponse
    {
        $estudanteId = Auth::guard('estudante')->user()->id;

        if (!$vaga->estudanteEstaEscrito($estudanteId)) {
            VagaEstudante::create([
                "vaga_id" => $vaga->id,
                "usuario_estudante_id" => $estudanteId
            ]);
            
            return response()->json(["message" => "Inscrição Realizada com sucesso"], 201);
        }

        return response()->json(["message" => "O estudante já está escrito na vaga"], 400);


    }

    public function removerInscricao(Vaga $vaga): JsonResponse
    {
        $estudanteId = Auth::guard('estudante')->user()->id;

        if ($vaga->estudanteEstaEscrito($estudanteId)) {
            $vaga = VagaEstudante::where('vaga_id', $vaga->id)->where('usuario_estudante_id', $estudanteId)->first();

            $vaga->delete();


            return response()->json(["message" => "Remoção da inscrição feita com sucesso"], 201);
        }

        return response()->json(["message" => "O estudante não está inscrito nessa vaga"], 400);
    }
}
