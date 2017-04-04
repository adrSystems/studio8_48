<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
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
