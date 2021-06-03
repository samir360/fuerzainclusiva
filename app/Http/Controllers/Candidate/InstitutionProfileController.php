<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;

use App\Models\UserInstitution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitutionProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('frontend.candidate.institution-list-ajax', ['institutions' => $user->userInstitutions]);
    }


    public function saveInstitutionProfile(Request $request)
    {
        $user = Auth::user();

        if (!$request->institution_name) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese la institución']);
        }

        if (!$request->obtained_title) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese titulo obtenido']);
        }

        $institution=UserInstitution::where([
            ['institution_name', '=', ucfirst(mb_strtolower($request->institution_name))],
            ['user_id', '=', $user->id]
        ])->first();


        if($institution instanceof UserInstitution){
            return response()->json(['status' => 'fail', 'alert' => 'El registro ya existe']);
        }

        UserInstitution::saveInstitution($request);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' => false]);
    }


    public function deleteInstitution(Request $request)
    {
        UserInstitution::deleteInstitution($request->id);
    }
}
