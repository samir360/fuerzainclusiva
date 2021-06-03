<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserExperience extends Model
{
    protected $fillable = [];

    protected $table = "users_work_experiences";


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id');
    }


    public static function saveExperience($request)
    {
        $experience = new self();
        $user = Auth::user();

        $experience->user_id = $user->id;
        $experience->company_name = ucfirst(mb_strtolower($request->company_name));
        $experience->company_functions = ucfirst(mb_strtolower($request->company_functions));
        $experience->industry_id = $request->industry_id;
        $experience->number_of_years = $request->number_of_years;
        $experience->save();

        return $experience;
    }



    public static function deleteExperience($id)
    {
        $experience = self::find($id);
        self::find($id)->forceDelete();
        return $experience;
    }
}
