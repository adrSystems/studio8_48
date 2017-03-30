<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;

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
    public function mensajes()
    {
      return $this->hasMany('App\Mensaje');
    }
    public function servicios(){
      return $this->belongsToMany('App\Servicio');
    }

    protected $dates = ['deleted_at'];
}
