<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function update(User $user, User $updateduser)
    {
        return $user->hasRole('administrator') || $user->id === $updateduser->id;
    }

    public function display(User $user, User $updateduser)
    {
        return $user->id === $updateduser->id;
    }
}
