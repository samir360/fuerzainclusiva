<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserPersonalReference extends Model
{

    protected $fillable = [];

    protected $table = "users_personal_references";


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public static function saveReference($request)
    {
        $reference = new self();
        $user = Auth::user();

        $reference->user_id = $user->id;
        $reference->full_name = ucfirst(mb_strtolower($request->full_name));
        $reference->charge = ucfirst(mb_strtolower($request->charge));
        $reference->reference_phone = ucfirst(mb_strtolower($request->reference_phone));
        $reference->reference_email = ucfirst(mb_strtolower($request->reference_email));
        $reference->save();

        return $reference;
    }



    public static function deleteReference($id)
    {
        $reference = self::find($id);
        self::find($id)->forceDelete();
        return $reference;
    }
    
    
}
