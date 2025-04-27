<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Especifico el nombre de la tabla
    protected $table = 'users';

    // Especifico la clave primaria'
    protected $primaryKey = 'dni';

    // Desactivo los timestamps si no se usa
    public $timestamps = false;

    // Especifico qué atributos son asignables masivamente
    protected $fillable = ['name', 'surname', 'dni', 'dateOfBirth', 'departmentId'];

    // Como no uso el campo 'id', lo desactivo
    public $incrementing = false;   // Esto indica que no uso un campo autoincrementable. He tenido que hacer esto pues 
    //como había definido el dni como primary key, en la respuesta del JSON me mostraba el id en lugar del dni; 
    //sin embargo en la base de datos lo hacía bien

    public function getRouteKeyName()
    {
        return 'dni';  // Indica que Laravel debe buscar por el campo "dni"
    }
    
    // Mutador para convertir departmentId a mayúsculas
    public function setDepartmentIdAttribute($value)
    {
        $this->attributes['departmentId'] = strtoupper($value);
    }

    // Mutador para capitalizar el nombre
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

    // Mutador para capitalizar el apellido
    public function setSurnameAttribute($value)
    {
        $this->attributes['surname'] = ucwords(strtolower($value));
    }
}
