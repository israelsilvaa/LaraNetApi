<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthEstudanteController extends Controller
{
    public function login(LoginFormRequest $request): JsonResponse
    {

        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('estudante')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = Auth::guard('estudante')->user();
        return response()->json(['token' => $token, "usuario" => $user]);


    }

    public function me(): JsonResponse
    {
        return response()->json(auth('estudante')->user());
    }

    public function logout(): JsonResponse
    {
        auth('estudante')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
