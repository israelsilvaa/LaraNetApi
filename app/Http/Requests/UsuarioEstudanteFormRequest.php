<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioEstudanteFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nome" => "required|max:100",
            "sobrenome" => "required|max:100",
            "email" => "required|email|unique:usuarios_estudantes",
            "data_nascimento" => "required|date",
            "password" => "required|min:8|confirmed",
        ];
    }

    public function atrributes()
    {

        return [
            "nome" => "Nome",
            "sobrenome" => "Sobrenome",
            "email" => "Email",
            "data_nascimento" => "Data Nascimento",
            "password" => "Senha",
            "password_confirmation" => "Repita a Senha",
        ];
    }
}
