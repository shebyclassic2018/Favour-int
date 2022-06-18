<?php

namespace App\Traits\Locations;

use App\Models\Roots\Station;

/**
 * 
 */
trait BelongsToStation
{
  public function station()
  {
    return $this->belongsTo(Station::class);
  }
}
