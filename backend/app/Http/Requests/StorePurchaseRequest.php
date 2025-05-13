<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'fromBatchNumber' => 'nullable|string',
            'toBatchNumber' => 'required',
            'fromLocation' => 'nullable|string',
            'toLocation' => 'required',
            'quantity' => 'required',
            'movementTypeId' => 'nullable|string', // Asignará "PU"
            'movementDate' => 'required|date',
            'customer' => 'nullable|string',
            'supplier' => 'required'
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
            'movementTypeId' => $this->movementTypeId ?? 'PU', // Asigna "PU" de PURCHASE
            'fromBatchNumber' => $this->fromBatchNumber ?? '', // Asigna "" 
            'fromLocation' => $this->fromLocation ?? '', // Asigna "" 
            'customer' => $this->customer ?? '', // Asigna "" 
        ]);
    }

    public function messages()
    {
        return [
            'productCode.required' => '⚠️ El código del producto es obligatorio.',
            'productCode.exists' => '⚠️ El código del producto no está registrado.',
            'toBatchNumber.required' => '⚠️ El lote de destino es obligatorio.',
            'toLocation.required' => '⚠️ La ubicación de destino es obligatoria.',
            'quantity.required' => '⚠️ La cantidad es obligatoria.',
            'movementDate.required' => '⚠️ La fecha de del movimiento es obligatoria.',
            'supplier.required' => '⚠️ El proveedor es obligatorio.',
        ];
    }
}
