<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\UserPersonalReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ReferenceProfileController extends Controller
{


    public function index()
    {
        $user = Auth::user();

        return view('frontend.candidate.reference-list-ajax', ['references' => $user->userReferences]);
    }


    public function saveReferenceProfile(Request $request)
    {
        $user = Auth::user();

        if (!$request->full_name) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese el nombre completo']);
        }

        if (!$request->charge) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese el cargo']);
        }

        if (!$request->reference_phone) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese el teléfono']);
        }

        if (!$request->reference_email) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese correo electrónico']);
        }

        if (!filter_var($request->reference_email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor ingrese un correo electrónico valido']);
        }

        $reference=UserPersonalReference::where([
            ['full_name', '=', ucfirst(mb_strtolower($request->full_name))],
            ['user_id', '=', $user->id]
        ])->first();


        if($reference instanceof UserPersonalReference){
            return response()->json(['status' => 'fail', 'alert' => 'El registro ya existe']);
        }

        UserPersonalReference::saveReference($request);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' => false]);
    }


    public function deleteReference(Request $request)
    {
        UserPersonalReference::deleteReference($request->id);
    }



}
