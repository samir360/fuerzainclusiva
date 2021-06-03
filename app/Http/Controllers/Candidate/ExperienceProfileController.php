<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;

use App\Models\UserExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('frontend.candidate.experience-list-ajax', ['experiences' => $user->userExperiences]);
    }


    public function saveExperienceProfile(Request $request)
    {
        $user = Auth::user();

        if (!$request->company_name) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese la compañia']);
        }

        if (!$request->company_functions) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese el cargo']);
        }

        if (!$request->industry_id) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor seleccione la insdustria']);
        }

        if (!$request->number_of_years) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese el año']);
        }

        $experience=UserExperience::where([
            ['company_name', '=', ucfirst(mb_strtolower($request->company_name))],
            ['user_id', '=', $user->id]
        ])->first();


        if($experience instanceof UserExperience){
            return response()->json(['status' => 'fail', 'alert' => 'El registro ya existe']);
        }

        UserExperience::saveExperience($request);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' => false]);
    }



    public function deleteExperience(Request $request)
    {
        UserExperience::deleteExperience($request->id);
    }
}
