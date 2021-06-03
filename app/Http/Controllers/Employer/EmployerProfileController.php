<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployerProfileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        return view('frontend.employer.employer-profile', ['user' => $user]);
    }


    public function updateEmployerProfile(Request $request)
    {
        $user = Auth::user();

        $userEmail = User::where([['email', '=', strtolower($request->email)], ['id', '!=', $user->id]])->first();

        if ($userEmail instanceof User) {
            return response()->json(['status' => 'fail', 'alert' => 'El correo electrónico ya existe']);
        }

        $user->firstname = ucfirst(mb_strtolower($request->firstname));
        $user->lastname = ucfirst(mb_strtolower($request->lastname));
        $user->email = strtolower($request->email);

        if($request->change_password){
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS')]);
    }
}
