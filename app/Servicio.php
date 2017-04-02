<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
  public $timestamps = false;
    public function empleados(){
      return $this->belongsToMany('App\Empleado');
    }
    public function citas(){
      return $this->belongsToMany('App\Cita')->withPivot('descuento');
    }
    public function promociones(){
      return $this->hasMany('App\Promocion');
    }
}
