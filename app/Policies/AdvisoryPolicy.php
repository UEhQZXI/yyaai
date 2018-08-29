<?php

namespace App\Policies;

use App\Models\Advisory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvisoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Advisory $advisory)
    {
        return $user->id === $advisory->user_id;
    }

    public function destroy(User $user, Advisory $advisory)
    {
        return $user->id === $advisory->user_id;
    }
}
