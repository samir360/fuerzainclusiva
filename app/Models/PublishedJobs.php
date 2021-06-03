<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PublishedJobs extends Model
{

    use SoftDeletes;

    const JOB_ACTIVE = 'ACTIVO';
    const JOB_INACTIVE = 'INACTIVO';

    const JOB_TIME_PARCIAL = 'TIEMPO PARCIAL';
    const JOB_TIME_COMPLETO = 'TIEMPO COMPLETO';

    const EXPERIENCE_1 = '1 AÑO';
    const EXPERIENCE_2 = '2 AÑOS';
    const EXPERIENCE_3 = '3 AÑOS';
    const EXPERIENCE_MAS = 'MÁS DE 3 AÑOS';

    const GENDER_M = 'MASCULINO';
    const GENDER_F = 'FEMENINO';
    const GENDER_O = 'MASCULINO O FEMENINO';

    const SCHEDULE_M = 'MAÑANA';
    const SCHEDULE_N = 'NOCHE';
    const SCHEDULE_A = 'MAÑANA Y NOCHE';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = "published_jobs";


    public function jobCompanies()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }


    public function jobCategories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\Application');
    }

    public function users()
    {
        return $this->hasMany('App\Models\Application');
    }


    public static function saveJob($request)
    {
        $job = new self();
        $user = Auth::user();

        $slug = str_slug(strtolower($request->job_title), '-');
        $company = $user->companies()->first();

        $job->company_id = $company->id;
        $job->job_title = mb_strtoupper($request->job_title);
        $job->job_slug = $slug;
        $job->job_time = $request->job_time;
        $job->category_id = $request->category_id;
        $job->minimum_salary = $request->minimum_salary;
        $job->maximum_salary = $request->maximum_salary;
        $job->education_id = $request->education_id;
        $job->year_of_experience = $request->year_of_experience;
        $job->website = $request->website;
        $job->country_id = $request->country_id;
        $job->email_address = $request->email_address;
        $job->gender = $request->gender;
        $job->schedule = $request->schedule;
        $job->job_description = $request->job_description;
        $job->job_status = PublishedJobs::JOB_ACTIVE;
        $job->save();

        return $job;
    }


    public static function updateJob($request)
    {
        $obj = new self();
        $job = $obj->find($request->id);

        $slug = str_slug(strtolower($request->job_title), '-');

        #$job->company_id = $request->company_id;
        $job->job_title = mb_strtoupper($request->job_title);
        $job->job_slug = $slug;
        $job->job_time = $request->job_time;
        $job->category_id = $request->category_id;
        $job->minimum_salary = $request->minimum_salary;
        $job->maximum_salary = $request->maximum_salary;
        $job->education_id = $request->education_id;
        $job->year_of_experience = $request->year_of_experience;
        $job->website = $request->website;
        $job->country_id = $request->country_id;
        $job->email_address = $request->email_address;
        $job->gender = $request->gender;
        $job->schedule = $request->schedule;
        $job->job_description = $request->job_description;
        $job->job_status = PublishedJobs::JOB_ACTIVE;
        $job->save();

        return $job;
    }


    public static function deletedJob($id)
    {
        $obj = new self();

        $job = $obj->find($id);

        $obj->find($id)->delete();

        return $job;
    }
}
