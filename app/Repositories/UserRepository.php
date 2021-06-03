<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends User
{

    public static function getUsers()
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


    public static function getUsersProfile($filter = null)
    {
        $query = User
            ::join('users_profiles', 'users.id', '=', 'users_profiles.user_id')
            ->join('countries', 'countries.id', '=', 'users_profiles.country_id')
            ->join('educations', 'educations.id', '=', 'users_profiles.education_id')
            ->select('users.email', 'users_profiles.profile_full_name', 'users_profiles.phone', 'users_profiles.gender', 'countries.name',
                'educations.education_name', 'users_profiles.address', 'users_profiles.photo', 'users_profiles.profile_slug', 'users_profiles.birthday',
                'users_profiles.created_at','users_profiles.user_id', 'users_profiles.id');


        if (isset($filter) and isset($filter['search'])) {
            $query->where('users_profiles.profile_full_name', 'LIKE', "%".$filter['search']."%");
        }

        if (isset($filter) and isset($filter['country_id'])) {
            $query->where('users_profiles.country_id', '=', $filter['country_id']);
        }

        if (isset($filter) and isset($filter['education_id'])) {
            $query->where('users_profiles.education_id', '=', $filter['education_id']);
        }

        if (isset($filter) and isset($filter['id'])) {
            $query->where('users_profiles.id', '=', $filter['id']);
        }

        if (isset($filter) and isset($filter['gender'])) {
            $query->where('users_profiles.gender', '=', $filter['gender']);
        }

        $query->orderBy('users_profiles.profile_full_name');


        ##dd($query->toSql());


        return $query;
    }


}


