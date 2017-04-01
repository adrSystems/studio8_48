<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    public $timestamps = false;
    public function servicios(){
      return $this->hasMany('App\Servicio');
    }
}
