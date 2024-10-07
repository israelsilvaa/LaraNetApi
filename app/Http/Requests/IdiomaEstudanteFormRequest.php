<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdiomaEstudanteFormRequest extends FormRequest
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
            "idioma_id" => "required|exists:idiomas,id",
            "nivel" => "required|in:Básico,Intermediário,Avançado",
        ];
    }


    public function attributes(): array
    {
        return [
            "idioma_id" => "Idioma",

            "nivel" => "Nível",
        ];
    }
}
