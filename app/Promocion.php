<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = "promociones";
    public function servicio()
    {
      $this->belongsTo('App\Servicio');
    }
}
