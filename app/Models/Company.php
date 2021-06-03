<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use SoftDeletes;

    const COMPANY_ACTIVE = 'ACTIVO';
    const COMPANY_INACTIVE = 'INACTIVO';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = "companies";


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


    public function jobs()
    {
        return $this->hasMany('App\Models\PublishedJobs');
    }


    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id');
    }


    public static function saveCompanyProfile($request)
    {
        $company = new self();

        $slug = str_slug(strtolower($request->company_name), '-');

        $company->user_id = Auth::user()->id;
        $company->company_name = mb_strtoupper($request->company_name);
        $company->company_slug = $slug;
        $company->company_email = strtolower($request->company_email);
        $company->person_contact = ucfirst(mb_strtolower($request->person_contact));
        $company->person_post = ucfirst(mb_strtolower($request->person_post));
        $company->person_email = strtolower($request->person_email);
        $company->person_phone = $request->person_phone;
        $company->industry_id = $request->industry_id;
        $company->company_location = $request->company_location;
        $company->company_desciption = $request->company_desciption;
        $company->company_status = $request->company_status;
        $company->save();

        return $company;
    }


    public static function updateCompanyProfile($request)
    {
        $obj = new self();
        $company = $obj->find($request->id);

        $slug = str_slug(strtolower($request->company_name), '-');

        $company->company_name = mb_strtoupper($request->company_name);
        $company->company_slug = $slug;
        $company->company_email = strtolower($request->company_email);
        $company->person_contact = ucfirst(mb_strtolower($request->person_contact));
        $company->person_post = ucfirst(mb_strtolower($request->person_post));
        $company->person_email = strtolower($request->person_email);
        $company->person_phone = $request->person_phone;
        $company->industry_id = $request->industry_id;
        $company->company_location = $request->company_location;
        $company->company_desciption = $request->company_desciption;
        $company->company_status = $request->company_status;
        $company->save();

        return $company;
    }



    public static function deletedCompany($id)
    {
        $obj = new self();

        $company = $obj->find($id);

        $obj->find($id)->delete();

        return $company;
    }

}
