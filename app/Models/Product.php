<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Especifico el nombre de la tabla
    protected $table = 'products';

    // Especifico la clave primaria'
    protected $primaryKey = 'productCode';

    // Desactivo los timestamps si no se usa
    public $timestamps = false;

    // Especifico qué atributos son asignables masivamente
    protected $fillable = ['productCode', 'productName','productCategoryId'];

    // Como no uso el campo 'id', lo desactivo
    public $incrementing = false;   // Esto indica que no uso un campo autoincrementable.
                                    //Permite usar una primary key distinta de id

    public function getRouteKeyName()
    {
        return 'productCode';  // Indica que Laravel debe por qué campo buscar
    }
    
    // Mutador para convertir a mayúsculas
    public function setProductCodeAttribute($value)
    {
        $this->attributes['productCode'] = strtoupper($value);
    }

    // Mutador para capitalizar el nombre
    public function setProductNameAttribute($value)
    {
        $this->attributes['productName'] = strtoupper($value);
    }

    // Mutador para capitalizar el nombre
    public function setProductCategoryIdAttribute($value)
    {
        $this->attributes['productCategoryId'] = strtoupper($value);
    }
}
