<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;

    public function cuenta(){
      return $this->morphOne('App\User','cuentable');
    }
    public function mensajes(){
      return $this->hasMany('App\Mensaje');
    }
}
