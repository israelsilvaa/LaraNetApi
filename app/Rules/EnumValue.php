<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class EnumValue implements Rule
{
    private string $enumClass;

    public function __construct(string $enumClass)
    {
        $this->enumClass = $enumClass;
    }

    public function passes($attribute, $value)
    {
        // Verifica se o valor é um caso válido do Enum
        return array_key_exists($value, $this->enumClass::cases());
    }

    public function message()
    {
        return 'O valor selecionado para :attribute é inválido.';
    }
}
