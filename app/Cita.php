<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    public $timestamps = false;
    public function empleado(){
      return $this->belongsTo('App\Empleado');
    }
    public function cliente(){
      return $this->belongsTo('App\Cliente');
    }
    public function productos(){
      return $this->belongsToMany('App\Producto')->withPivot('cantidad');
    }
    public function servicios(){
      return $this->belongsToMany('App\Servicio')->withPivot('descuento','precio');
    }
    public function pagos()
    {
      return $this->morphMany('App\Pago','pagable');
    }
}
