<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioEmpresaFormRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:255'],
            'razao_social' => ['required', 'string', 'max:255', 'unique:usuarios_empresas,razao_social'],
            "image_logo" => ["required", "mimes:jpg,png,jpeg", "max:10240"],
            'porte' => ['required', 'in:MEI,ME,EPP,MEDIA_EMPRESA,GRANDE_EMPRESA'],
            'descricao' => ['required', 'string'],
            'cnpj' => ['required', 'string', 'size:18', 'unique:usuarios_empresas,cnpj', 'cnpj'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios_empresas,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'razao_social' => 'Razão Social',
            'porte' => 'Porte',
            'descricao' => 'Descrição',
            'cnpj' => 'CNPJ',
            'email' => 'Email',
            'password' => 'Senha',
            "image_logo" => "Imagem da Logo",
            'password_confirmation' => 'Repita a Senha',
        ];
    }
}