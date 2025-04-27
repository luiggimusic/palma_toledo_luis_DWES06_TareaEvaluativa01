<?php

use Illuminate\Support\Facades\Route;

// User
Route::get('user/get','App\Http\Controllers\UserController@getAllUsers')
->name('userGet_ruta');
Route::get('user/getId','App\Http\Controllers\UserController@getUserById')
->name('userGetId_ruta');
Route::post('user/create','App\Http\Controllers\UserController@createUser')
->name('createUser_ruta');
Route::put('user/update','App\Http\Controllers\UserController@updateUser')
->name('updateUser_ruta');
Route::delete('user/delete','App\Http\Controllers\UserController@deleteUser')
->name('deleteUser_ruta');

// ProductCategory
Route::get('productcategory/get','App\Http\Controllers\ProductCategoryController@getAllProductCategories')
->name('productCategoryGet_ruta');
Route::get('productcategory/getId','App\Http\Controllers\ProductCategoryController@getProductCategoryById')
->name('productCategoryGetId_ruta');
Route::post('productcategory/create','App\Http\Controllers\ProductCategoryController@createProductCategory')
->name('createProductCategory_ruta');
Route::put('productcategory/update','App\Http\Controllers\ProductCategoryController@updateProductCategory')
->name('updateProductCategory_ruta');
Route::delete('productcategory/delete','App\Http\Controllers\ProductCategoryController@deleteProductCategory')
->name('deleteProductCategory_ruta');

// Department
Route::get('department/get','App\Http\Controllers\DepartmentController@getAllDepartments')
->name('departmentGet_ruta');
Route::get('department/getId','App\Http\Controllers\DepartmentController@getDepartmentById')
->name('departmentGetId_ruta');
Route::post('department/create','App\Http\Controllers\DepartmentController@createDepartment')
->name('createDepartment_ruta');
Route::put('department/update','App\Http\Controllers\DepartmentController@updateDepartment')
->name('updateDepartment_ruta');
Route::delete('department/delete','App\Http\Controllers\DepartmentController@deleteDepartment')
->name('deleteDepartment_ruta');

// MovementType
Route::get('movementType/get','App\Http\Controllers\MovementTypeController@getAllMovementTypes')
->name('movementTypeGet_ruta');
Route::get('movementType/getId','App\Http\Controllers\MovementTypeController@getMovementTypeById')
->name('movementTypeGetId_ruta');
Route::post('movementType/create','App\Http\Controllers\MovementTypeController@createMovementType')
->name('createMovementType_ruta');
Route::put('movementType/update','App\Http\Controllers\MovementTypeController@updateMovementType')
->name('updateMovementType_ruta');
Route::delete('movementType/delete','App\Http\Controllers\MovementTypeController@deleteMovementType')
->name('deleteMovementType_ruta');

// Product
Route::get('product/get','App\Http\Controllers\ProductController@getAllProducts')
->name('ProductGet_ruta');
Route::get('product/getId','App\Http\Controllers\ProductController@getProductById')
->name('productGetId_ruta');
Route::post('product/create','App\Http\Controllers\ProductController@createProduct')
->name('createProduct_ruta');
Route::put('product/update','App\Http\Controllers\ProductController@updateProduct')
->name('updateProduct_ruta');
Route::delete('product/delete','App\Http\Controllers\ProductController@deleteProduct')
->name('deleteProduct_ruta');

// Movement
Route::get('movement/get','App\Http\Controllers\MovementController@getAllMovements')
->name('MovementGet_ruta');
Route::get('movement/get/filtered','App\Http\Controllers\MovementController@getMovementFiltered')
->name('movementGetFiltered_ruta');
Route::post('movement/sale','App\Http\Controllers\MovementController@sale')
->name('sale_ruta');
Route::post('movement/purchase','App\Http\Controllers\MovementController@purchase')
->name('purchase_ruta');
Route::post('movement/inventoryTransfer','App\Http\Controllers\MovementController@inventoryTransfer')
->name('inventoryTransfer_ruta');



