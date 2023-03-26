<?php

namespace App\Policies;

use Seblhaire\Specialauth\Models\User;
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

    public function update_user(User $current_user, User $updateduser)
    {
        return $current_user->hasRole('administrator') || $current_user->id === $updateduser->id;
    }

    public function display_user(User $current_user, User $displayed_user)
    {
        return $current_user->id === $displayed_user->id;
    }
}
