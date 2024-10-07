<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormacaoAcademicaFormRequest extends FormRequest
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
            
            "tipo_grau" => "required|in:Tecnólogo,Graduação,Pós-Graduação,Mestrado,Doutorado",
            "status" => "required|in:Completo,Em andamento,Incompleto",
            "curso_id" => "required|exists:cursos,id",
            "instituicao_nome" => "required|max:255",
            "data_inicio" => "required|date",
            "data_fim" => "required|date|after:data_inicio",

        ];
    }

    public function attributes(): array
    {
        return [
            "tipo_grau" => "Grau Acadêmico",
            "status" => "Status",
            "curso_id" => "Curso",
            "instituicao_nome" => "Nome da Instituição",
            "data_inicio" => "Data de Início",
            "data_fim" => "Data de Término",
        ];
    }
}
