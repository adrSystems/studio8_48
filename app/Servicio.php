<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
    public function empleados(){
      return $this->belongsToMany('App\Empleado');
    }
    public function citas(){
      return $this->belongsToMany('App\Cita')->withPivot('descuento');
    }

}
