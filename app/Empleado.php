<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public $timestamps = false;

    public function cuenta(){
      return $this->morphOne('App\User','cuentable');
    }
    public function roles(){
      return $this->belongsToMany('App\Rol');
    }
    public function citas(){
      return $this->hasMany('App\Cita');
    }
    public function servicios(){
      return $this->belongsToMany('App\Servicio');
    }
}
