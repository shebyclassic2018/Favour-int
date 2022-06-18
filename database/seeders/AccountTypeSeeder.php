<?php

namespace Database\Seeders;

use App\Models\Roots\AccountType;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // $AccountTypes = ['Individual', 'Company'];
    $AccountTypes = AccountType::ACCOUNT_TYPES;
    foreach ($AccountTypes as $key => $value) {
      AccountType::create(['id' => $key, 'name' => $value]);
    }
  }
}
