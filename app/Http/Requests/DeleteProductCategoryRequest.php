<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class DeleteProductCategoryRequest extends FormRequest
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
            'productCategoryId' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Verifica si existe en la tabla productcategories
                    if (!DB::table('productcategories')->where('productCategoryId', $value)->exists()) {
                        return $fail('⚠️ La categoría de producto no existe.');
                    }

                    // Verifica si está relacionada en la tabla products
                    if (DB::table('products')->where('productCategoryId', $value)->exists()) {
                        return $fail('⚠️ La categoría de producto tiene relaciones existentes y no se puede eliminar.');
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'productCategoryId.required' => '⚠️ El código de la categoría de producto es obligatorio.',
        ];
    }
}
