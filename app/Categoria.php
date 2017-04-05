<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
  use SoftDeletes;
  public $timestamps = false;
  public function marcas()
  {
    return $this->belongsToMany('App\Marca');
  }

  public function subcategorias()
  {
    return $this->hasMany('App\Subcategoria');
  }
}
