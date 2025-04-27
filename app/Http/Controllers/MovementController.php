<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movement;
use App\Http\Resources\MovementResource;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\StoreInventoryTransferRequest;
use App\Models\Inventory;

use function PHPUnit\Framework\isEmpty;

class MovementController extends Controller
{
    function getAllMovements()
    {
        // Relaciono los movimientos con las clases Product y MovementType para mostrar en la respuesta
        // los datos relacionados, por ejemplo productName y movementTypeName
        // Para esto he creado el recurso MovementResource en el que he definido el formato de la respuesta JSON
        $movements = Movement::with(['product', 'movementType'])->get();
        $response = MovementResource::collection($movements);

        if ($response->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ No se encontraron movimientos',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $response
        ]);
    }
    function getMovementFiltered(Request $request)
    {
        $query = Movement::query()->with(['product', 'movementType']);

        // Filtra por productName si se proporciona
        if ($request->has('productName') && $request->productName != '') {
            // Aquí hago posible la resquest sea accesible a la tabla products, pues buscará por productName
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('productName', 'LIKE', '%' . $request->productName . '%');
            });
        }

        // Filtra por productCode si se proporciona
        if ($request->has('productCode') && $request->productCode != '') {
            $query->where('productCode', 'like', '%' . $request->productCode . '%');
        }
        // Filtra por fromBatchNumber si se proporciona
        if ($request->has('fromBatchNumber') && $request->fromBatchNumber != '') {
            $query->where('fromBatchNumber', $request->fromBatchNumber);
        }
        // Filtra por toBatchNumber si se proporciona
        if ($request->has('toBatchNumber') && $request->toBatchNumber != '') {
            $query->where('toBatchNumber', $request->toBatchNumber);
        }
        // Filtra por fromLocation si se proporciona
        if ($request->has('fromLocation') && $request->fromLocation != '') {
            $query->where('fromLocation', $request->fromLocation);
        }
        // Filtra por toLocation si se proporciona
        if ($request->has('toLocation') && $request->toLocation != '') {
            $query->where('toLocation', $request->toLocation);
        }
        // Filtra por quantity si se proporciona
        if ($request->has('quantity') && $request->quantity != '') {
            $query->where('quantity', $request->quantity);
        }
        // Filtra por movementTypeId si se proporciona
        if ($request->has('movementTypeId') && $request->movementTypeId != '') {
            $query->where('movementTypeId', $request->movementTypeId);
        }
        // Filtra por movementDate si se proporciona
        if ($request->has('movementDate') && $request->movementDate != '') {
            $query->where('movementDate', $request->movementDate);
        }
        // Filtra por customer si se proporciona
        if ($request->has('customer') && $request->customer != '') {
            $query->where('customer', $request->customer);
        }
        // Filtra por supplier si se proporciona
        if ($request->has('supplier') && $request->supplier != '') {
            $query->where('supplier', $request->supplier);
        }

        $movements = $query->with(['product', 'movementType'])->get();
        $response = MovementResource::collection($movements);

        if ($response->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ No se han encontrado movimientos',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $response
        ]);
    }

    function sale(StoreSaleRequest $request)
    {
        // Busca en el inventario por productCode, batchNumber y location
        $inventory = Inventory::where('productCode', $request->productCode)
            ->where('batchNumber', $request->fromBatchNumber)
            ->where('location', $request->fromLocation)->first();

        // Verifica si hay suficiente stock
        if (!$inventory || $inventory->stock < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => "⚠️ No hay suficiente stock para este movimiento.",
                'data' => []
            ], 400);
        } else {
            // Si hay suficiente stock, crea el movimiento
            $movement = Movement::create($request->validated());
            // Resta la cantidad del inventario
            $inventory->decrement('stock', $movement->quantity);
            // Si el stock llega a 0, elimina el registro de inventario
            if ($inventory->stock <= 0) {
                $inventory->delete();
            }
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => '✅ Movimiento creado correctamente',
                'data' => $movement
            ]);
        }
    }
    function purchase(StorePurchaseRequest $request)
    {
        // Busca en el inventario por productCode, batchNumber y location
        $inventory = Inventory::where('productCode', $request->productCode)
            ->where('batchNumber', $request->toBatchNumber)
            ->where('location', $request->toLocation)->first();

        $movement = Movement::create($request->validated());

        // Verifica si hay stock del producto y lote, si no existe, crea una nueva línea
        if (!$inventory) {
            $inventory = Inventory::create([
                'productCode' => $movement->productCode,
                'batchNumber' => $movement->toBatchNumber,
                'location' => $movement->toLocation,
                'stock' => $movement->quantity,
            ]);
        } else {
            // Suma la cantidad al inventario
            $inventory->increment('stock', $movement->quantity);
        }

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Movimiento creado correctamente',
            'data' => $movement
        ]);
    }

    function inventoryTransfer(StoreInventoryTransferRequest $request)
    {
        // ****** STOCK DE ORIGEN ****** //
        // Busca en el inventario por productCode, batchNumber y location
        $stockOrigen = Inventory::where('productCode', $request->productCode)
            ->where('batchNumber', $request->fromBatchNumber)
            ->where('location', $request->fromLocation)->first();

        // Verifica si hay suficiente stock
        if (!$stockOrigen || $stockOrigen->stock < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => "⚠️ No hay suficiente stock para este movimiento.",
                'data' => []
            ], 400);
        } else {
            // Si hay suficiente stock, crea el movimiento
            $movement = Movement::create($request->validated());
            // Resta la cantidad del inventario
            $stockOrigen->decrement('stock', $movement->quantity);
            // Si el stock llega a 0, elimina el registro de inventario
            if ($stockOrigen->stock <= 0) {
                $stockOrigen->delete();
            }

            // ****** STOCK DE DESTINO ****** //
            // Verifica si hay stock del producto y lote, si no existe, crea una nueva línea
            $stockDestino = Inventory::where('productCode', $request->productCode)
                ->where('batchNumber', $request->toBatchNumber)
                ->where('location', $request->toLocation)->first();

            if (!$stockDestino) {
                $stockDestino = Inventory::create([
                    'productCode' => $movement->productCode,
                    'batchNumber' => $movement->toBatchNumber,
                    'location' => $movement->toLocation,
                    'stock' => $movement->quantity,
                ]);
            } else {
                // Suma la cantidad al inventario
                $stockDestino->increment('stock', $movement->quantity);
            }

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => '✅ Movimiento creado correctamente',
                'data' => $movement
            ]);
        }
    }
}
