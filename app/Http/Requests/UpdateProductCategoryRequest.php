<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductCategoryRequest extends FormRequest
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
            'productCategoryId' => 'required',
            'productCategoryName' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'productCategoryId.required' => '⚠️ El ID de categoría es obligatorio.',
            'productCategoryName.required' => '⚠️ El nombre de la categoría de producto es obligatorio.',
        ];
    }
}
