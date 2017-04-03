<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    public function categorias()
    {
      return $this->belongsToMany('App\Categoria');
    }
}
