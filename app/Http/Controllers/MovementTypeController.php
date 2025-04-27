<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MovementType;
use App\Http\Requests\StoreMovementTypeRequest;
use App\Http\Requests\UpdateMovementTypeRequest;
use App\Http\Requests\DeleteMovementTypeRequest;

class MovementTypeController extends Controller
{
    function getAllMovementTypes()
    {
        $movementType = MovementType::all();

        if ($movementType->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ No se encontraron tipos de movimiento',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $movementType
        ]);
    }

    function getMovementTypeById(Request $request)
    {
        $id = $request->input('movementTypeId');

        // Busca por id
        $movementType = MovementType::where('movementTypeId', $id)->first();

        // Si el id no existe, devuelve error
        if (!$movementType) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Tipo de movimiento no encontrado: ' . $id
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $movementType
        ]);
    }

    function createMovementType(StoreMovementTypeRequest $request)
    {
        $movementType = MovementType::create($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Tipo de movimiento creado correctamente',
            'data' => $movementType
        ]);
    }

    function updateMovementType(UpdateMovementTypeRequest $request) {
        $id = $request->input('movementTypeId');

        // Busca por id
        $movementType = MovementType::where('movementTypeId', $id)->first();

        // Si el id no existe, devuelve error
        if (!$movementType) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Tipo de movimiento no encontrado: ' . $id
            ], 404);
        }

        $movementType->update($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Tipo de movimiento actualizado correctamente',
            'data' => $movementType
        ]);
    }
    function deleteMovementType(DeleteMovementTypeRequest $request) {
        $id = $request->input('movementTypeId');

        // Busca por id
        $movementType = MovementType::where('movementTypeId', $id)->first();

        $movementType->delete($id);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Tipo de movimiento eliminado correctamente',
            'data' => $movementType
        ]);        
    }
}
