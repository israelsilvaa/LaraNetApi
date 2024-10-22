<?php

namespace App\Http\Controllers;
use App\Models\UsuarioEmpresa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmpresasDestaqueController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): JsonResponse
    {
        $empresas = UsuarioEmpresa::inRandomOrder()->take(6)->get();
        return response()->json($empresas);
    }
}
