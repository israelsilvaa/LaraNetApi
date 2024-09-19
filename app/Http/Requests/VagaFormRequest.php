<?php

namespace App\Http\Requests;

use App\Enums\TipoEstagio;
use App\Enums\Turno;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EnumValue;
class VagaFormRequest extends FormRequest
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
            "nome" => "required|max:255",
            "descricao" => "required|max:3500",
            "tipo_estagio" => ["required", "in:Presencial,Remoto,Híbrido"],
            "turno" => ["required", "in:Matutino,Vespertino,Noturno"],
            "valor" => "nullable|numeric",
            'cursos' => "required|array|min:1",
            'cursos.*' => 'exists:cursos,id',

        ];
    }

    public function atrributes(): array
    {

        return [
            "nome" => "Nome",
            "descricao" => "Descricao",
            "tipo_estagio" => "Tipo de Estagio",
            "turno" => "Turno",
            "valor" => "Valor",
            'cursos' => "Cursos"
        ];
    }
}
