<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Model
{
    use SoftDeletes;

    const GENDER_M = 'MASCULINO';
    const GENDER_F = 'FEMENINO';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = "users_profiles";


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function education()
    {
        return $this->belongsTo('App\Models\Education', 'education_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }


    public static function saveProfile($request)
    {
        $profile = new self();
        $user = Auth::user();
        $slug = str_slug(strtolower($request->first_name . ' ' . $request->last_name), '-');

        $profile->user_id = $user->id;
        $profile->profile_full_name = ucwords(mb_strtolower($request->first_name) . ' ' . mb_strtolower($request->last_name));
        $profile->profile_slug = $slug;
        $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        $profile->birthday = $request->birthday;
        $profile->country_id = $request->country_id;
        $profile->education_id = $request->education_id;
        $profile->address = $request->address;
        $profile->personal_description = ucfirst(mb_strtolower($request->personal_description));
        $profile->save();

        return $profile;
    }


    public static function updateProfile($request)
    {
        $obj = new self();
        $user = Auth::user();

        $profile = $obj->find($user->userProfile->id);
        $slug = str_slug(strtolower($request->first_name . ' ' . $request->last_name), '-');

        $profile->profile_full_name = ucwords(mb_strtolower($request->first_name) . ' ' . mb_strtolower($request->last_name));
        $profile->profile_slug = $slug;
        $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        $profile->birthday = $request->birthday;
        $profile->country_id = $request->country_id;
        $profile->education_id = $request->education_id;
        $profile->address = $request->address;
        $profile->personal_description = ucfirst(mb_strtolower($request->personal_description));
        $profile->save();

        return $profile;
    }
}
