<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class DeleteMovementTypeRequest extends FormRequest
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
            'movementTypeId' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Verifica si existe en la tabla movementtypes
                    if (!DB::table('movementtypes')->where('movementTypeId', $value)->exists()) {
                        return $fail('⚠️  Tipo de movimiento no encontrado.');
                    }

                    // Verifica si está relacionado en la tabla movements
                    if (DB::table('movements')->where('movementTypeId', $value)->exists()) {
                        return $fail('⚠️ El tipo de movimiento tiene relaciones existentes y no se puede eliminar.');
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'movementTypeId.required' => '⚠️ El tipo de movimiento es obligatorio.',
        ];
    }
}
