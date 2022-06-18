<?php

namespace App\Traits\Peoples;

use App\Models\Peoples\Account;

/**
 * 
 */
trait BelongsToAccount
{
  public function account()
  {
    return $this->belongsTo(Account::class);
  }
}
