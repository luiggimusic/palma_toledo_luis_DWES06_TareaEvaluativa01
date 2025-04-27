<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    function getAllDepartments()
    {
        $departments = Department::all();

        if ($departments->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ No se encontraron departamentos',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $departments
        ]);
    }

    function getDepartmentById(Request $request)
    {
        $id = $request->input('departmentId');
        // Busca por id
        $department = Department::where('departmentId', $id)->first();

        // Si el id no existe, devuelve error
        if (!$department) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Departamento no encontrado: ' . $id
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Datos cargados correctamente',
            'data' => $department
        ]);
    }

    function createDepartment(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Departamento creado correctamente',
            'data' => $department
        ]);
    }

    function updateDepartment(UpdateDepartmentRequest $request)
    {
        $id = $request->input('departmentId');

        // Busca por id
        $department = Department::where('departmentId', $id)->first();

        // Si el id no existe, devuelve error
        if (!$department) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Departamento no encontrado: ' . $id
            ], 404);
        }

        $department->update($request->validated());

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Departamento actualizado correctamente',
            'data' => $department
        ]);
    }

    function deleteDepartment(Request $request)
    {
        $id = $request->input('departmentId');

        // Verifica si hay usuarios en el departamento
        if (\App\Models\User::where('departmentId', $id)->exists()) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => '⚠️ No se puede eliminar el departamento porque tiene usuarios asociados.'
            ], 400);
        }

        // Busca por id
        $department = Department::where('departmentId', $id)->first();

        // Si el id no existe, devuelve error
        if (!$department) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => '⚠️ Departamento no encontrado: ' . $id
            ], 404);
        }

        $department->delete($id);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => '✅ Departamento eliminado correctamente',
            'data' => $department
        ]);
    }
}
