<?php

namespace App\Traits\Shared;

use App\Services\CompanyService;

/**
 * 
 */
trait PropertyHandlerTraits
{
  protected function prepareSystem()
  {
    return (new CompanyService)->HandleGetSystemCompany();
  }

}
