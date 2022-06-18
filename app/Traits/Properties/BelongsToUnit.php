<?php

namespace App\Traits\Properties;

use App\Models\Properties\Unit;


/**
 * 
 */
trait BelongsToUnit
{
  public function unit()
  {
    return $this->belongsTo(Unit::class);
  }
}
