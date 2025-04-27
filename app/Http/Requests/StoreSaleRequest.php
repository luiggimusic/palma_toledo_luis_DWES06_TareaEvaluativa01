<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'productCode' => ['required','exists:products,productCode'],
            'fromBatchNumber' => 'required',
            'toBatchNumber' => 'nullable|string',
            'fromLocation' => 'required',
            'toLocation' => 'nullable|string',
            'quantity' => 'required',
            'movementTypeId' => 'nullable|string', // Asignará "SA"
            'movementDate' => 'required|date',
            'customer' => 'required',
            'supplier' => 'nullable|string'
        ];
    }

    protected function prepareForValidation()
    {
        // Convierte la fecha antes de la validación
        if ($this->has('movementDate')) {
            $this->merge([
                'movementDate' => formatDate($this->movementDate) // Convierte a YYYY-MM-DD
            ]);
        }

        $this->merge([
            'movementTypeId' => $this->movementTypeId ?? 'SA', // Asigna "SA" de SALE
            'toBatchNumber' => $this->toBatchNumber ?? '', // Asigna "" 
            'toLocation' => $this->toLocation ?? '', // Asigna "" 
            'supplier' => $this->supplier ?? '', // Asigna "" 
        ]);
    }

    public function messages()
    {
        return [
            'productCode.required' => '⚠️ El código del producto es obligatorio.',
            'productCode.exists' => '⚠️ El código del producto no está registrado.',
            'fromBatchNumber.required' => '⚠️ El lote de origen es obligatorio.',
            'fromLocation.required' => '⚠️ La ubicación de origen es obligatoria.',
            'quantity.required' => '⚠️ La cantidad es obligatoria.',
            'movementDate.required' => '⚠️ La fecha de del movimiento es obligatoria.',
            'customer.required' => '⚠️ El cliente es obligatorio.',
        ];
    }
}
