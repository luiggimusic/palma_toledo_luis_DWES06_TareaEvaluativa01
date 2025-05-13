<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovementType extends Model
{
    // Especifico el nombre de la tabla
    protected $table = 'movementtypes';

    // Especifico la clave primaria'
    protected $primaryKey = 'movementTypeId';

    // Desactivo los timestamps si no se usa
    public $timestamps = false;

    // Especifico qué atributos son asignables masivamente
    protected $fillable = ['movementTypeId', 'movementTypeName'];

    // Como no uso el campo 'id', lo desactivo
    public $incrementing = false;   // Esto indica que no uso un campo autoincrementable.
                                    //Permite usar una primary key distinta de id

    public function getRouteKeyName()
    {
        return 'movementTypeId';  // Indica que Laravel debe por qué campo buscar
    }
    
    // Mutador para convertir a mayúsculas
    public function setMovementTypeIdAttribute($value)
    {
        $this->attributes['movementTypeId'] = strtoupper($value);
    }

    // Mutador para capitalizar el nombre
    public function setMovementTypeNameAttribute($value)
    {
        $this->attributes['movementTypeName'] = ucwords(strtolower($value));
    }
}
