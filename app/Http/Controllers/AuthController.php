<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ApiService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $regras = [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];

        $feedback = [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.min' => 'O seu nome deve ter no mínimo :min letras.',
            'name.max' => 'O seu nome deve ter no máximo :max letras.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'O campo senha deve ser uma string.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'As senhas não são iguais.',
        ];

        $validator = Validator($request->all(), $regras, $feedback);

        if ($validator->fails()) {
            return ApiService::statusCode422($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return ApiService::statusCode201($user);
    }

    public function login(LoginFormRequest $request)
    {
        $request->validated();
        $credenciais = $request->all();

        $token = Auth('api')->attempt($credenciais);

        if ($token) {
            return ApiService::statusCode200(['Token' => $token]);
        }
        return ApiService::statusCode403("Erro de usuário ou senha");
    }

    public function logout()
    {
        auth('api')->logout();
        return ApiService::statusCode200("Logout foi realizado com sucesso");
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return ApiService::statusCode200(['Token' => $token]);
    }

    public function me()
    {
        $user = Auth::user();
        return ApiService::statusCode200(['User' => $user]);
    }
}
