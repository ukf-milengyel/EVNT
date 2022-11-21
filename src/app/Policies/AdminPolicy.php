<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    public static function isAdmin(User $user){
        if ($user->group == NULL) return false;
        return $user->group->permissions & 0b1;
    }
}
