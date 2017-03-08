<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  public function citas(){
    return $this->belongsToMany('App\Cita');
  }
}
