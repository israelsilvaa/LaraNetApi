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
            "curriculo" => "required|mimes:pdf|max:10120",
            "email" => "required|email|unique:usuarios_estudantes",
            'cpf' => "required|cpf|unique:usuarios_estudantes",
            "data_nascimento" => "required|date",
            "password" => "required|min:8|confirmed",
        ];
    }

    public function atrributes(): array
    {

        return [
            "nome" => "Nome",
            "cpf" => "CPF",
            "sobrenome" => "Sobrenome",
            "email" => "Email",
            "curriculo" => "Currículo",
            "data_nascimento" => "Data Nascimento",
            "password" => "Senha",
            "password_confirmation" => "Repita a Senha",
        ];
    }
}
