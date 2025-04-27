<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Especifico el nombre de la tabla
    protected $table = 'departments';

    // Especifico la clave primaria'
    protected $primaryKey = 'departmentId';

    // Desactivo los timestamps si no se usa
    public $timestamps = false;

    // Especifico qué atributos son asignables masivamente
    protected $fillable = ['departmentId', 'departmentName'];

    // Como no uso el campo 'id', lo desactivo
    public $incrementing = false;   // Esto indica que no uso un campo autoincrementable.
                                    //Permite usar una primary key distinta de id

    public function getRouteKeyName()
    {
        return 'departmentId';  // Indica que Laravel debe por qué campo buscar
    }
    
    // Mutador para convertir a mayúsculas
    public function setDepartmentIdAttribute($value)
    {
        $this->attributes['departmentId'] = strtoupper($value);
    }

    // Mutador para capitalizar el nombre
    public function setDepartmentNameAttribute($value)
    {
        $this->attributes['departmentName'] = ucwords(strtolower($value));
    }
}
