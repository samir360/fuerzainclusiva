<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Repositories\EducationRepository;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Request $request, $route = null)
    {
        $filter=$request->get('filter');

        $educations = EducationRepository::getEducations($filter)->paginate(15);

        return view('backend.register.table-education', [
            'educations' => $educations,
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
        return view('backend.forms.forms-education', [
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
        $filter = ['education_name' => $request->get('education_name')];

        $educations = EducationRepository::getEducations($filter)->get();

        if (!$educations->isEmpty()) {
            return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL')]);
        }

        Education::saveEducation($request);

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
        $data = Education::find($id);

        return view('backend.forms.forms-education', [
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

        $education = Education::updateEducation($request);

        if ($education) {
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
        $education = Education::deleteEducation($request->id);

        if ($education) {
            return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS_DELETE')]);
        }

        return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL_DELETE')]);
    }

}
