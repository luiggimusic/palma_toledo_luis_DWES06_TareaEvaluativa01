<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movement extends Model
{

    // Relación con Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'productCode');
    }

    // Relación con MovementType (si existe)
    public function movementType()
    {
        return $this->belongsTo(MovementType::class, 'movementTypeId');
    }

    // Especifico el nombre de la tabla
    protected $table = 'movements';

    // Desactivo los timestamps si no se usa
    public $timestamps = false;

    // Especifico qué atributos son asignables masivamente
    protected $fillable = [
        'productCode',
        'fromBatchNumber',
        'toBatchNumber',
        'fromLocation',
        'toLocation',
        'quantity',
        'movementTypeId',
        'movementDate',
        'customer',
        'supplier'
    ];

    // Como no uso el campo 'id', lo desactivo
    public $incrementing = false;   // Esto indica que no uso un campo autoincrementable.
    //Permite usar una primary key distinta de id

    // public function getRouteKeyName()
    // {
    //     return 'departmentId';  // Indica que Laravel debe por qué campo buscar
    // }

    // Mutador para convertir a mayúsculas
    // public function setDepartmentIdAttribute($value)
    // {
    //     $this->attributes['departmentId'] = strtoupper($value);
    // }

    // Mutador para capitalizar el nombre
    // public function setDepartmentNameAttribute($value)
    // {
    //     $this->attributes['departmentName'] = ucwords(strtolower($value));
    // }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($movement) {
    //         // Verifica si el tipo de movimiento es "sa" (sale)
    //         if ($movement->movementTypeId === 'sa') {
    //             Inventory::where('productCode', $movement->productCode)
    //                 ->decrement('stock', $movement->quantity);
    //         }
    //     });

    // }
}
