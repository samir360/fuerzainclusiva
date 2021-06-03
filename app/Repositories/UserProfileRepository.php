<?php

namespace App\Repositories;

use App\Models\User;

class UserProfileRepository extends User
{

    public static function getUsersProfile()
    {
        $users = User
            ::join('roles', 'users.rol_id', '=', 'roles.id')
            ->select('users.id', 'users.email', 'users.firstname', 'users.lastname', 'users.user_status', 'roles.name', 'roles.created_at')
            ->where('roles.id', '!=', User::ROL_EMPLOYER)
            ->orderBy('users.firstname')
            ->paginate(50);

        return $users;
    }



   public static function verifyUser($email)
    {
        $users = User::query()->where('email', '=', $email)->first();
        return $users;
    }
}


