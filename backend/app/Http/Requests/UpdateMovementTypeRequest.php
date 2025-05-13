<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovementTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'movementTypeId' => 'required',
            'movementTypeName' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'movementTypeId.required' => '⚠️ El ID del tipo de movimiento es obligatorio.',
            'movementTypeName.required' => '⚠️ El nombre del tipo de movimiento es obligatorio.',
        ];
    }  
}
