<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidDNI implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Self::validarDNI($value)) {
            $fail('⚠️ El formato del DNI es incorrecto.');
            return;
        }
    }

    // Validación del DNI del usuario
    private function letraNif($numero)
    {
        return substr("TRWAGMYFPDXBNJZSQVHLCKE", strtr($numero, "XYZ", "012") % 23, 1);
    }

    private function validarDNI($dni)
    {
        $numero = substr($dni, 0, 8);
        $letra = Self::letraNif($numero);
        return $dni == $numero . $letra;
    }
}
