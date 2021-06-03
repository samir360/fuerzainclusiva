<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Repositories\IndustryRepository;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index(Request $request, $route = null)
    {
        $filter=$request->get('filter');

        $industries = IndustryRepository::getInsdustries($filter)->paginate(15);

        return view('backend.register.table-industry', [
            'industries' => $industries,
            'filter' => $filter,
            'route' => $route

        ])->withErrors('Oops! no existe registro para mostrar');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($route = null)
    {
        return view('backend.forms.forms-industry', [
            'route' => $route
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filter = ['industry_name' => $request->get('industry_name')];

        $industries = IndustryRepository::getInsdustries($filter)->get();

        if (!$industries->isEmpty()) {
            return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL')]);
        }

        Industry::saveIndustry($request);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS')]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $route = null)
    {
        $data = Industry::find($id);

        return view('backend.forms.forms-industry', [
            'route' => $route,
            'data' => $data
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $industry = Industry::updateIndustry($request);

        if ($industry) {
            return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS')]);
        }

        return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL')]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $industry = Industry::deleteIndustry($request->id);

        if ($industry) {
            return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS_DELETE')]);
        }

        return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL_DELETE')]);
    }

}
