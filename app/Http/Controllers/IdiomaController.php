<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $idiomas = Idioma::orderBy('nome')->get();

        return response()->json($idiomas, 200);
    }
}
