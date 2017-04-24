<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $timestamps = false;

    public function productos()
    {
      return $this->belongsToMany('App\Producto')->withPivot('precio_venta','cantidad');
    }

    public function cliente()
    {
      return $this->belongsTo('App\Cliente');
    }

    public function pagos()
    {
      return $this->morphMany('App\Pago','pagable');
    }

    public function monto()
    {
      $monto = 0;
      foreach ($this->productos()->withTrashed()->get() as $i => $p) {
        $monto += $p->pivot->precio_venta * $p->pivot->cantidad;
      }
      return $monto;
    }
}
