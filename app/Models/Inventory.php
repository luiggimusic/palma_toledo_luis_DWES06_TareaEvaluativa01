<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Especifico el nombre de la tabla
    protected $table = 'inventory';

    // Desactivo los timestamps si no se usa
    public $timestamps = false;

    // Especifico qué atributos son asignables masivamente
    protected $fillable = [
        'productCode',
        'batchNumber',
        'location',
        'stock',
    ];
}
