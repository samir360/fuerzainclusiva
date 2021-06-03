<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = "contacts";



    public static function saveContact($request)
    {
        $user=Auth::user();

        $contact = new self();

        $contact->user_id = $user->id;
        $contact->subject = $request->subject;
        $contact->comments = $request->comments;
        $contact->save();

        return $contact;
    }

}
