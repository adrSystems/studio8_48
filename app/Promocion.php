<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    public $timestamps = false;
    protected $table = "promociones";
    public function servicios(){
      return $this->hasMany('App\Servicio');
    }
}
