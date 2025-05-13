<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\utils\ApiResponse;

class UserController extends Controller
{
    function getAllUsers()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ No se encontraron usuarios',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $users
        ]);
    }

    function getUserById(Request $request)
    {
        $dni = $request->input("dni");

        $users = DB::table('users')->where('dni', $dni)->get();

        if ($users->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ No se encontraron usuarios',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $users
        ]);
    }

    function createUser(StoreUserRequest $request)
    {
        // Si la validación falla, Laravel automáticamente devuelve los errores que he definido en StoreUserRequest
        $user = User::create($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Usuario creado correctamente',
            'data' => $user
        ]);
    }

    function updateUser(UpdateUserRequest $request)
    {
        $dni=$request->input("dni");

        // Busca el usuario por DNI
        $user = User::where('dni', $dni)->first();

        // Si el usuario no existe, devuelve error
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Usuario no encontrado con DNI: ' . $dni
            ], 404);
        }

        $user->update($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $user
        ]);
    }

    function deleteUser(Request $request)
    {
        $dni=$request->input("dni");

        // Busca el usuario por DNI
        $user = User::where('dni', $dni)->first();

        // Si el usuario no existe, devuelve error
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Usuario no encontrado con DNI: ' . $dni
            ], 404);
        }

        $user->delete($request);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Usuario eliminado correctamente',
            'data' => $user
        ]);
    }
}
