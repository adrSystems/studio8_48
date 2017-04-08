<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{
  use SoftDeletes;
  public $timestamps = false;

  public function categoria()
  {
    return $this->belongsTo('App\Categoria');
  }

  public function productos()
  {
    return $this->hasMany('App\Producto');
  }
}
