<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{

  use SoftDeletes;

  public $timestamps = false;

  public function citas(){
    return $this->belongsToMany('App\Cita')->withPivot('cantidad');
  }

  public function compras()
  {
    return $this->belongsToMany('App\Compra')->withPivot('precio_venta');
  }

  public function subcategoria()
  {
    return $this->belongsTo('App\Subcategoria');
  }

  public function surticiones()
  {
    return $this->hasMany('App\Surticion');
  }
}
