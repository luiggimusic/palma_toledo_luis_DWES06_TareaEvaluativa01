<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Requests\DeleteProductCategoryRequest;

class ProductCategoryController extends Controller
{
    function getAllProductCategories()
    {
        $productCategories = ProductCategory::all();

        if ($productCategories->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ No se encontraron categorías de producto',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Datos cargados correctamente',
            'data' => $productCategories
        ]);
    }

    function getProductCategoryById(Request $request)
    {
        $id = $request->input('productCategoryId');

        // Busca por id
        $productCategory = ProductCategory::where('productCategoryId', $id)->first();

        // Si el id no existe, devuelve error
        if (!$productCategory) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Categoría de producto no encontrada: ' . $id
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $productCategory
        ]);
    }

    function createProductCategory(StoreProductCategoryRequest $request)
    {
        $productCategory = ProductCategory::create($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Categoría de producto creada correctamente',
            'data' => $productCategory
        ]);
    }

    function updateProductCategory(UpdateProductCategoryRequest $request)
    {
        $id = $request->input('productCategoryId');

        // Busca por id
        $productCategory = ProductCategory::where('productCategoryId', $id)->first();

        // Si el id no existe, devuelve error
        if (!$productCategory) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Categoría de producto no encontrada: ' . $id
            ], 404);
        }

        $productCategory->update($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $productCategory
        ]);
    }

    function deleteProductCategory(DeleteProductCategoryRequest $request)
    {
        $id = $request->input('productCategoryId');

        // Busca por id
        $productCategory = ProductCategory::where('productCategoryId', $id)->first();

        $productCategory->delete($id);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Categoría de producto eliminada correctamente',
            'data' => $productCategory
        ]);
    }
}
