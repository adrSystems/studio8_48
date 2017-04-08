<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surticion extends Model
{
    protected $table = "surticiones";
    public $timestamps = false;

    public function productos()
    {
      return $this->belongsTo('App\Producto');
    }
}
