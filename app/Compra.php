<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public function productos()
    {
      return $this->belongsToMany('App\Producto');
    }

    public function cliente()
    {
      return $this->belongsTo('App\Cliente');
    }

    public function pagos()
    {
      return $this->morphMany('App\Pago','pagable');
    }
}
