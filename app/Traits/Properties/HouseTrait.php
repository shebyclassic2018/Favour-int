<?php
namespace App\Traits\Properties;

use App\Models\Properties\House;

/**
 * 
 */
trait HouseTrait
{

  protected function allHousesInDB(Array $withModels)
  {
    return House::with($withModels)->get();
  }
  
}
