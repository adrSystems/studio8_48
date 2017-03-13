<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table="mensajes";
    public $timestamps=false;

    public function cliente()
    {
      return $this->belongsTo('App\Cliente');
    }
}
