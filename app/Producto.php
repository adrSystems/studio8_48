<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{

  use SoftDeletes;

  public function citas(){
    return $this->belongsToMany('App\Cita');
  }

  public function compras()
  {
    return $this->belongsToMany('App\Compra');
  }

  public function subcategoria()
  {
    return $this->belongsTo('App\Subcategoria');
  }
}
