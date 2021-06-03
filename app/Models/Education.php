<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

    const EDUCATION_ACTIVE = 'ACTIVO';
    const EDUCATION_INACTIVE = 'INACTIVO';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = "educations";

    public function profileEducations()
    {
        return $this->hasMany('App\Models\UserProfile');
    }


    public static function saveEducation($request)
    {
        $education = new self();

        $education->education_name = ucfirst(mb_strtolower($request->education_name));
        $education->education_status = $request->education_status;
        $education->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($education, 'saveEducation', [
            'education' => $education
        ]);

        return $education;
    }



    public static function updateEducation($request)
    {
        $obj = new self();
        $education = $obj->find($request->id);

        $education->education_name = ucfirst(mb_strtolower($request->education_name));
        $education->education_status = $request->education_status;
        $education->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($education, 'updateEducation', [
            'education' => $education
        ]);

        return $education;
    }



    public static function deleteEducation($id)
    {
        $education = self::find($id);
        self::find($id)->delete();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($education, 'deleteEducation', [
            'education' => $education
        ]);

        return $education;
    }
}
