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
}
