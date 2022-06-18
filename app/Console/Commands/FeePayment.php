<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Roots\Role;
use Illuminate\Console\Command;
use App\Interfaces\StatusBroker;
use App\Models\Mophs\AssociatedWith;
use App\Interfaces\Services\PaymentBroker;
use App\Models\Roots\Package;
use App\Traits\Financials\PaymentTrait;

class FeePayment extends Command
{
    use PaymentTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fee:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will make sure all required account to be added to the Fee payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $allUsers = User::whereIn('role_id', getEncodedDecodedJson(getEncodedDecodedJson(constClientRoles()), 'decode'))
            ->where('role_id', '!=', Role::IS_TENANT)->get();
        $associates = AssociatedWith::get()->pluck('account_id');

        foreach ($allUsers as $user) {
            if (!in_array($user->account->id, $associates->toArray())) {
                if ($user->account->package_role_id !== Package::IS_POA) {
                    if (method_exists($this, 'insertIntFeePayment')) {
                        $params = getEncodedDecodedJson([
                            'flag' => PaymentBroker::CREATE_FRAG,
                            'feeType' => StatusBroker::PACKAGE_FEE
                        ]);
                        $this->insertIntFeePayment($user, $params);
                    }
                }
            }
        }

        $this->info(today() . '');
    }
}
