<?php

namespace App\Models;

use Crediminuto\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const ROL_ADMIN = 1;
    const ROL_OPERATOR = 2;
    const ROL_EMPLOYER = 3;
    const ROL_CANDIDATE = 4;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function rol()
    {
        return $this->belongsTo('App\Models\Role', 'rol_id');
    }


    public function companies()
    {
        return $this->hasMany('App\Models\Company');
    }


    public function userProfile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }


    public function userInstitutions()
    {
        return $this->hasMany('App\Models\UserInstitution');
    }


    public function userExperiences()
    {
        return $this->hasMany('App\Models\UserExperience');
    }


    public function userReferences()
    {
        return $this->hasMany('App\Models\UserPersonalReference');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\Application');
    }



    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token));
    }

    public static function saveUser($request)
    {
        $user = new self();

        $user->rol_id = $request->rol_id;
        $user->firstname = ucfirst(mb_strtolower($request->firstname));
        $user->lastname = ucfirst(mb_strtolower($request->lastname));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->user_status = $request->user_status;
        $user->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($user, 'saveUser', [
            'users' => $user
        ]);

        return $user;
    }



    public static function updateUser($request)
    {
        $obj = new self();
        $user = $obj->find($request->id);

        $user->rol_id = $request->rol_id;
        $user->firstname = ucfirst(mb_strtolower($request->firstname));
        $user->lastname = ucfirst(mb_strtolower($request->lastname));
        $user->email = strtolower($request->email);
        $user->user_status = $request->user_status;
        $user->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($user, 'updateUser', [
            'users' => $user
        ]);

        return $user;
    }



    public static function deleteUser($id)
    {
        $user = self::find($id);
        self::find($id)->delete();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($user, 'deleteUser', [
            'users' => $user
        ]);

        return $user;
    }

}
