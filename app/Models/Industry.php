<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{

    const INDUSTRY_ACTIVE = 'ACTIVO';
    const INDUSTRY_INACTIVE = 'INACTIVO';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    public function userProfileIndustry()
    {
        return $this->hasOne('App\Models\UserProfile');
    }

    public function experience()
    {
        return $this->hasMany('App\Models\UserExperience');
    }

    public function company()
    {
        return $this->hasOne('App\Models\Company');
    }

    public static function saveIndustry($request)
    {
        $industry = new self();

        $industry->industry_name = ucfirst(mb_strtolower($request->industry_name));
        $industry->industry_status = $request->industry_status;
        $industry->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($industry, 'saveIndustry', [
            'industry' => $industry
        ]);

        return $industry;
    }


    public static function updateIndustry($request)
    {
        $obj = new self();
        $industry = $obj->find($request->id);

        $industry->industry_name = ucfirst(mb_strtolower($request->industry_name));
        $industry->industry_status = $request->industry_status;
        $industry->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($industry, 'updateIndustry', [
            'industry' => $industry
        ]);

        return $industry;
    }



    public static function deleteIndustry($id)
    {
        $industry = self::find($id);
        self::find($id)->delete();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($industry, 'deleteIndustry', [
            'industry' => $industry
        ]);

        return $industry;
    }
}
