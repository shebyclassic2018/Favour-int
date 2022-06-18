<?php

namespace App\Traits\Locations;

use App\Models\Roots\Ward;

/**
 * 
 */
trait BelongsToWard
{
  public function ward()
  {
    return $this->belongsTo(Ward::class);
  }
}
