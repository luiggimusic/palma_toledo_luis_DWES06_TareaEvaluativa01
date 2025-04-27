<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovementTypeRequest extends FormRequest
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
            'movementTypeId' => 'required|unique:movementtypes,movementTypeId',
            'movementTypeName' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'movementTypeId.required' => '⚠️ El ID del tipo de movimiento es obligatorio.',
            'movementTypeId.unique' => '⚠️ El ID del tipo de movimiento ya está registrado.',
            'movementTypeName.required' => '⚠️ El nombre del tipo de movimiento es obligatorio.',
        ];
    }    
}
