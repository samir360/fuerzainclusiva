<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserInstitution extends Model
{
    protected $fillable = [];

    protected $table = "users_institutionals";


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public static function saveInstitution($request)
    {
        $institution = new self();
        $user = Auth::user();

        $institution->user_id = $user->id;
        $institution->institution_name = ucfirst(mb_strtolower($request->institution_name));
        $institution->obtained_title = ucfirst(mb_strtolower($request->obtained_title));
        $institution->save();

        return $institution;
    }



    public static function deleteInstitution($id)
    {
        $institution = self::find($id);
        self::find($id)->forceDelete();
        return $institution;
    }

}
