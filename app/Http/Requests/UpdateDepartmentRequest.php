<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
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
            'departmentId' => 'required',
            'departmentName' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'departmentId.required' => '⚠️ El ID del departamento es obligatorio.',
            'departmentName.required' => '⚠️ El nombre del departamento es obligatorio.',
        ];
    }
}
