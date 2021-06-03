<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;

use App\Models\Country;
use App\Models\Education;
use App\Models\Industry;
use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\IndustryRepository;
use App\Repositories\UserRepository;
use App\Services\PhotoImportServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class CandidateProfileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $countries = Country::query()->orderBy('name', 'ASC')->get();

        $education = Education::query()->orderBy('education_name', 'ASC')->get();

        $candidates = UserRepository::getUsersProfile(null)->paginate(15);

        return view('frontend.candidate.candidate', [
            'user' => $user,
            'countries' => $countries,
            'education' => $education,
            'candidates' => $candidates,
        ])->withErrors('Oops! no existe registro para mostrar');
    }


    public function profileCandidate()
    {
        $user = Auth::user();

        $filter = ['status' => Industry::INDUSTRY_ACTIVE];

        $industries = IndustryRepository::getInsdustries($filter)->get();

        $countries = Country::query()->orderBy('name', 'ASC')->get();

        $education = Education::query()->orderBy('education_name', 'ASC')->get();

        $profile = null;
        if ($user->userProfile instanceof UserProfile) {
            $profile = $user->userProfile;
        }

        return view('frontend.candidate.candidate-profile', [
            'user' => $user,
            'industries' => $industries,
            'countries' => $countries,
            'education' => $education,
            'profile' => $profile,
        ]);
    }


    public function candidateList(Request $request)
    {
        $user = Auth::user();

        $filter = $request->filter;

        $countries = Country::query()->orderBy('name', 'ASC')->get();

        $education = Education::query()->orderBy('education_name', 'ASC')->get();

        $candidates = UserRepository::getUsersProfile($filter)->paginate(15);

        $filterIndustry = ['status' => Industry::INDUSTRY_ACTIVE];

        $industries = IndustryRepository::getInsdustries($filterIndustry)->get();

        return view('frontend.candidate.candidate-list', [
            'user' => $user,
            'countries' => $countries,
            'education' => $education,
            'candidates' => $candidates,
            'industries' => $industries,
            'filter' => $filter,
        ])->withErrors('Oops! no existe registro para mostrar');
    }


    public function saveProfile(Request $request)
    {
        $user = Auth::user();

        $userEmail = User::where([['email', '=', strtolower($request->email)], ['id', '!=', $user->id]])->first();

        if ($userEmail instanceof User) {
            return response()->json(['status' => 'fail', 'alert' => 'El correo electrónico ya existe']);
        }


        if (!$request->country_id) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor seleccione la provincia']);
        }

        $profile = UserProfile::saveProfile($request);

        $PhotoImportServices = new PhotoImportServices();

        $PhotoImportServices->importPhotoProfileUser($profile, $request);

        $user = $profile->user;
        $user->firstname = ucwords(mb_strtolower($request->first_name));
        $user->lastname = ucwords(mb_strtolower($request->last_name));
        $user->email = strtolower($request->email);
        $user->save();


        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' => false]);
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $userEmail = User::where([['email', '=', strtolower($request->email)], ['id', '!=', $user->id]])->first();

        if ($userEmail instanceof User) {
            return response()->json(['status' => 'fail', 'alert' => 'El correo electrónico ya existe']);
        }

        if (!$request->country_id) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor seleccione la provincia']);
        }

        $profile = UserProfile::updateProfile($request);

        $PhotoImportServices = new PhotoImportServices();

        $PhotoImportServices->importPhotoProfileUser($profile, $request);


        $user = $profile->user;
        $user->firstname = ucwords(mb_strtolower($request->first_name));
        $user->lastname = ucwords(mb_strtolower($request->last_name));
        $user->email = strtolower($request->email);

        if($request->change_password){
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' => false]);
    }


    public function profileDetailCandidate($slug)
    {
        $id=explode("-", Crypt::decryptString($slug));

        $userProfile = User::find(end($id));

        $user = Auth::user();

        return view('frontend.candidate.candidate-detail-profile', [
            'userProfile' => $userProfile,
            'user' => $user,
            'references' => $userProfile->userReferences,
            'experiences' => $userProfile->userExperiences,
            'institutions' => $userProfile->userInstitutions,
            'profile' => $userProfile->userProfile,
            'country' => $userProfile->userProfile->country->name,
        ]);
    }


}
