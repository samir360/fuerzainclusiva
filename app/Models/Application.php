<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    protected $fillable = [];

    protected $table = "applications";




    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }


    public function jobs()
    {
        return $this->belongsTo('App\Models\PublishedJobs', 'id');
    }

    public static function saveApplication($request)
    {
        $applications = new self();
        $user = Auth::user();

        $applications->user_id = $user->id;
        $applications->published_jobs_id = $request->id;
        $applications->save();

        return $applications;
    }

}
