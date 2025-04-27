<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'productCategoryId' => 'required|unique:productcategories,productCategoryId',
            'productCategoryName' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'productCategoryId.required' => '⚠️ El ID de categoría es obligatorio.',
            'productCategoryId.unique' => '⚠️ El ID de categoría ya está registrado.',
            'productCategoryName.required' => '⚠️ El nombre de la categoría de producto es obligatorio.',
        ];
    }
}
