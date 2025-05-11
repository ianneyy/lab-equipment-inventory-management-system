<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function accessDashboard(User $user)
    {
        return $user->roles === 'admin';
    }
}
