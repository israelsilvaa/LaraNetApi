<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioEmpresaUpdateFormRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:255'],
            'razao_social' => ['required', 'string', 'max:255', Rule::unique('usuarios_empresas')->ignore($userId)],
            "image_logo" => ["nullable", "mimes:jpg,png,jpeg", "max:10240"],
            'porte' => ['required', 'in:MEI,ME,EPP,MEDIA_EMPRESA,GRANDE_EMPRESA'],
            'descricao' => ['required', 'string'],
            'cnpj' => ['required', 'string', 'size:18', Rule::unique('usuarios_empresas')->ignore($userId), 'cnpj'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('usuarios_empresas')->ignore($userId)],

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

            "image_logo" => "Imagem da Logo",

        ];
    }
}
