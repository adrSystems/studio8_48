<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "roles";
    public $timestamps = false;

    public function empleados(){
      return $this->belongsToMany('App\Empleado');
    }
}
