<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UsuarioEstudanteUpdateFormRequest extends FormRequest
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
        $userId = $this->user()->id;

        return [
            "nome" => "required|max:100",
            "sobrenome" => "required|max:100",
            "curriculo" => "nullable|mimes:pdf|max:10120",
            "email" => [
                "required",
                "email",
                Rule::unique('usuarios_estudantes')->ignore($userId),
            ],
            'cpf' => [
                "required",
                "cpf",
                Rule::unique('usuarios_estudantes')->ignore($userId),
            ],
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
