<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;

use App\Models\Company;
use App\Models\Industry;
use App\Models\User;
use App\Repositories\CompanyRepository;
use App\Repositories\IndustryRepository;
use App\Repositories\PublishedJobsRepository;
use App\Services\PhotoImportServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CompanyProfileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $company = $user->companies()->first();

        $filter = ['status' => Industry::INDUSTRY_ACTIVE];

        $industries = IndustryRepository::getInsdustries($filter)->get();

        return view('frontend.employer.company-profile', ['user' => $user, 'industries' => $industries, 'company' => $company]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filter = ['company_name' => $request->get('company_name')];

        $company = CompanyRepository::getCompanies($filter)->get();

        if (!$company->isEmpty()) {
            return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL_EXIST')]);
        }

        $company = Company::saveCompanyProfile($request);

        $PhotoImportServices = new PhotoImportServices();

        $PhotoImportServices->importLogoCompany($company, $request);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' => false]);
    }


    public function listCompanies()
    {
        $user = Auth::user();

        $companies = $user->companies;

        return view('frontend.employer.company-list', ['user' => $user, 'companies' => $companies]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Company $Company
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = Auth::user();

        $filter = ['status' => Industry::INDUSTRY_ACTIVE];

        $industries = IndustryRepository::getInsdustries($filter)->get();

        $company = $user->companies()->where('company_slug', '=', $slug)->first();

        if (!$company instanceof Company) {
            return redirect()->route('company-profile');
        }

        return view('frontend.employer.company-profile', [
            'user' => $user,
            'company' => $company,
            'industries' => $industries
        ]);
    }


    public function update(Request $request)
    {
        $company = Company::updateCompanyProfile($request);

        $PhotoImportServices = new PhotoImportServices();

        $PhotoImportServices->importLogoCompany($company, $request);

        if ($company) {
            return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' => true]);
        }

        return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL')]);
    }


    public function companyDeleted(Request $request)
    {
        Company::deletedCompany($request->id);

        PublishedJobsRepository::deletedPostCompany($request->id);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' => true]);
    }




    public function profileDetailCompany($slug)
    {
        $id=explode("-", Crypt::decryptString($slug));

        $company = Company::find(end($id));

        $user = Auth::user();

        return view('frontend.employer.company-detail-profile', [
            'company' => $company,
            'industry' => $company->industry,
            'user' => $user,
        ]);
    }


}
