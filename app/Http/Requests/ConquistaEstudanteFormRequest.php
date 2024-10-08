<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConquistaEstudanteFormRequest extends FormRequest
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
            "tipo" => "required|in:Certificado,Curso,Reconhecimento,Trabalho Voluntário",
            "titulo" => "required|max:255",
            "descricao" => "required|max:500",

        ];
    }

    public function atrributes(): array
    {
        return [
            "tipo" => "Tipo",
            "titulo" => "Título",
            "descricao" => "Descrição",
        ];
    }
}
