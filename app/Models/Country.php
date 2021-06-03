<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = "countries";


    public function userProfileCountry()
    {
        return $this->hasOne('App\Models\UserProfile');
    }
}
