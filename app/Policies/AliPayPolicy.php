<?php

namespace App\Policies;

use App\Models\Store\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AliPayPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function own(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }
}
