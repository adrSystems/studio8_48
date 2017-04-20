<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado_Rol extends Model
{
    protected $table = 'empleado_rol';
    public $timestamps = "false";

    public function empleados()
    {
      return $this->belongsTo("App\Empleado");
    }

    public function roles()
    {
      return $this->belongsTo("App\Rol");
    }
}
