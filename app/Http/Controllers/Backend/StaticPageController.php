<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\StaticPageRepository;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($route = null)
    {
        $staticPages = StaticPageRepository::getStaticPage(null, null)->paginate(15);

        return view('backend.static-page.table-static-page', [
            'staticPages' => $staticPages,
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
        return view('backend.forms.forms-static-page', [
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
        StaticPage::saveStaticPage($request);
        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS')]);
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $route=null)
    {
        $staticPages = StaticPage::find($id);

        return view('backend.forms.forms-static-page', [
            'route' => $route,
            'staticPages' => $staticPages
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $staticPage = StaticPage::updateStaticPage($request);

        if ($staticPage) {
            return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS')]);
        }

        return response()->json(['status' => 'success', 'alert' => env('MSJ_FAIL')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $staticPage = StaticPage::deleteStaticPage($request->id);

        if ($staticPage) {
            return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS_DELETE')]);
        }

        return response()->json(['status' => 'success', 'alert' => env('MSJ_FAIL_DELETE')]);
    }


}
