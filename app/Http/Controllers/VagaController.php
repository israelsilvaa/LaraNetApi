<?php

namespace App\Http\Controllers;

use App\Http\Requests\VagaFormRequest;
use App\Models\Vaga;
use App\Models\VagaEstudante;
use App\Services\VagaService;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VagaController extends Controller
{

    protected VagaService $vagaService;


    public function __construct(VagaService $vagaService)
    {

        $this->vagaService = $vagaService;
    }



    public function index(Request $request): JsonResponse
    {
        $vagas = $this->vagaService->search($request->all())->paginate(10);


        return response()->json($vagas);
    }

    public function showVagasByEmpresaAuth(): JsonResponse
    {

        $userID = Auth::guard('empresa')->user()->id;
        $vagas = $this->vagaService->getVagasByEmpresa($userID)->paginate(10);

        return response()->json($vagas);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VagaFormRequest $request): JsonResponse
    {
        $dados = $request->validated();


        $userID = Auth::guard('empresa')->user()->id;
        $vaga = $this->vagaService->save($dados, $userID);

        return response()->json($vaga);

    }

    /**
     * Display the specified resource.
     */
    public function show(Vaga $vaga): JsonResponse
    {
        return response()->json($vaga);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(VagaFormRequest $request, Vaga $vaga): JsonResponse
    {

        $this->authorizeForUser(auth()->guard('empresa')->user(), 'update', $vaga);
        $dados = $request->validated();



        $vaga = $this->vagaService->update($dados, $vaga);

        return response()->json($vaga);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaga $vaga)
    {

        $this->authorizeForUser(auth()->guard('empresa')->user(), 'delete', $vaga);
        $vaga->delete();


        return response()->noContent();

    }

    public function inscreverEstudanteVaga(Vaga $vaga)
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
}
