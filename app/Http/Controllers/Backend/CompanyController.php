<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        #$filter = ['status' => Com];

        $companies = CompanyRepository::getCompanies()->paginate(12);

        return view('backend.Company.table-company', ['companies' => $companies])->withErrors('Oops! no existe registro para mostrar');
    }
}
