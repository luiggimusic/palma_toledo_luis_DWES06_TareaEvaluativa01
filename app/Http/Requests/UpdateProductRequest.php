<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'productCode' => 'required',
            'productName' => 'required',
            'productCategoryId' => ['required','exists:productcategories,productCategoryId']
        ];
    }

    public function messages()
    {
        return [
            'productCode.required' => '⚠️ El código del producto es obligatorio.',
            'productCode.unique' => '⚠️ El código del producto ya está registrado.',
            'productName.required' => '⚠️ El nombre del producto es obligatorio.',
            'productCategoryId.required' => '⚠️ La categoría del producto es obligatoria.',
            'productCategoryId.exists' => '⚠️ La categoría de producto no existe.',

        ];
    }
}
