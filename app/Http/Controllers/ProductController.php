<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\DeleteProductRequest;

class ProductController extends Controller
{
    function getAllProducts()
    {

        $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ No se encontraron productos',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $products
        ]);
    }

    function getProductById(Request $request)
    {
        // Busca por id
        $id = $request->input('productCode');

        $product = Product::where('productCode',$id)->first();

        // Si el id no existe, devuelve error
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Producto no encontrado: ' . $id
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $product
        ]);
    }

    function createProduct(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Producto creado correctamente',
            'data' => $product
        ]);
    }

    function updateProduct(UpdateProductRequest $request)
    {
        $id = $request->input('productCode');

        $product = Product::where('productCode',$id)->first();

        // Si el id no existe, devuelve error
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Producto no encontrado: ' . $id
            ], 404);
        }

        $product->update($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Producto actualizado correctamente',
            'data' => $product
        ]);
    }

    function deleteProduct(DeleteProductRequest $request)
    {
        $id = $request->input('productCode');

        $product = Product::where('productCode',$id)->first();

        $product->delete($id);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Producto eliminado correctamente',
            'data' => $product
        ]);
    }
}
