<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidDNI;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // Convierte la fecha antes de la validación
        if ($this->has('dateOfBirth')) {
            $this->merge([
                'dateOfBirth' => formatDate($this->dateOfBirth) // Convierte a YYYY-MM-DD
            ]);
        }

        // Convierte el DNI a mayúscula antes de la validación
        if ($this->has('dni')) {
            $this->merge([
                'dni' => strtoupper($this->dni)
            ]);
        }
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'dni' => ['required', 'string',new ValidDNI()],
            'dateOfBirth' => 'required|date',
            'departmentId' => ['required', 'string', 'exists:departments,departmentId']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '⚠️ El nombre es obligatorio.',
            'surname.required' => '⚠️ El apellido es obligatorio.',
            'dni.required' => '⚠️ El DNI es obligatorio.',
            'dateOfBirth.required' => '⚠️ La fecha de nacimiento es obligatoria.',
            'dateOfBirth.date_format' => '⚠️ La fecha debe estar en formato dd/mm/yyyy.',
            'dateOfBirth.date' => '⚠️ La fecha de nacimiento debe ser una fecha válida.',
            'departmentId.required' => '⚠️ El ID del departamento es obligatorio.',
            'departmentId.exists' => '⚠️ El ID del departamento no está registrado.',
        ];
    }
}
