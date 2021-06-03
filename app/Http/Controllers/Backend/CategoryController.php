<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, $route = null)
    {
        $filter=$request->get('filter');

        $categories = CategoryRepository::getCategories($filter)->paginate(15);

        return view('backend.register.table-category', [
            'categories' => $categories,
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
        return view('backend.forms.forms-category', [
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
        $filter = ['category_name' => $request->get('category_name')];

        $categories = CategoryRepository::getCategories($filter)->get();

        if (!$categories->isEmpty()) {
            return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL')]);
        }

        Category::saveCategory($request);

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
        $data = Category::find($id);

        return view('backend.forms.forms-category', [
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

        $categories = Category::updateCategory($request);

        if ($categories) {
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
        $categories = Category::deleteCategory($request->id);

        if ($categories) {
            return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS_DELETE')]);
        }

        return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL_DELETE')]);
    }

}
