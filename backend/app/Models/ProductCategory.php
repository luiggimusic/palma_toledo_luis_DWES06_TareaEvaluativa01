<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // Especifico el nombre de la tabla
    protected $table = 'productcategories';

    // Especifico la clave primaria'
    protected $primaryKey = 'productCategoryId';

    // Desactivo los timestamps si no se usa
    public $timestamps = false;

    // Especifico qué atributos son asignables masivamente
    protected $fillable = ['productCategoryId', 'productCategoryName'];

    // Como no uso el campo 'id', lo desactivo
    public $incrementing = false;   // Esto indica que no uso un campo autoincrementable.
                                    //Permite usar una primary key distinta de id

    public function getRouteKeyName()
    {
        return 'productCategoryId';  // Indica que Laravel debe por qué campo buscar
    }
    
    // Mutador para convertir a mayúsculas
    public function setProductCategoryIdAttribute($value)
    {
        $this->attributes['productCategoryId'] = strtoupper($value);
    }

    // Mutador para capitalizar el nombre
    public function setProductCategoryNameAttribute($value)
    {
        $this->attributes['productCategoryName'] = ucwords(strtolower($value));
    }
}
