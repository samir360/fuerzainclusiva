<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Repositories\AplicationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $aplications = AplicationRepository::getMyAplications($user->id)->paginate(6);

        return view('frontend.candidate.my-applications', ['user' => $user, 'aplications' => $aplications]);
    }


    public function saveApplication(Request $request)
    {
        Application::saveApplication($request);

        return response()->json(['status' => 'success']);
    }
}
