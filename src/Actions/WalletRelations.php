<?php

namespace MshMsh\Actions;

use Modules\User\Controllers\Api\PaymentController;
use Modules\User\Models\UserWallet;

trait WalletRelations
{
    public function wallet_actions()
    {
        return $this->hasMany(UserWallet::class);
    }

    public function orderCharge($user_id)
    {
        return \Modules\Orders\Controllers\PaymentController::link($user_id);
    }
    public function charge($amount)
    {
        return PaymentController::link($amount);
    }
}
