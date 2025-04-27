<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;


class DeleteProductRequest extends FormRequest
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
            'productCode' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Verifica si existe en la tabla products
                    if (!DB::table('products')->where('productCode', $value)->exists()) {
                        return $fail('⚠️ El código de producto no existe.');
                    }

                    // Verifica si está relacionada en la tabla inventory
                    if (DB::table('inventory')->where('productCode', $value)->exists()) {
                        return $fail('⚠️ El producto tiene relaciones existentes y no se puede eliminar.');
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'productCode.required' => '⚠️ El código de producto es obligatorio.',
        ];
    }
}
