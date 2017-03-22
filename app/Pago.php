<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    public function pagable()
    {
      return $this->morphTo();
    }
}
