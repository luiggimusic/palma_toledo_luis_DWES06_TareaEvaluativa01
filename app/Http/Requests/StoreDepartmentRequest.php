<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
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
            'departmentId' => 'required|unique:departments,departmentId',
            'departmentName' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'departmentId.required' => '⚠️ El ID del departamento es obligatorio.',
            'departmentId.unique' => '⚠️ El ID del departamento ya está registrado.',
            'departmentName.required' => '⚠️ El nombre del departamento es obligatorio.',
        ];
    }
}
