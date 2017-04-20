<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    public $timestamps = false;
    public function pagable()
    {
      return $this->morphTo();
    }
}
