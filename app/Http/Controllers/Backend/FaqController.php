<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $route = null)
    {
        $faqs = FaqRepository::getFaqs(null)->get();
        $view = 'table-faqs';

        if ($route == 1) {
            $view = 'table-details-faqs';
        }

        return view('backend.static-page.' . $view, [
            'request' => $request,
            'faqs' => $faqs,
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
        return view('backend.forms.frm-faq', [
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
        Faq::saveFaq($request);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' =>false]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \Crediminuto\Faq $Faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $route = null)
    {
        $faq = Faq::find($id);

        return view('backend.forms.frm-faq', [
            'route' => $route,
            'faq' => $faq
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Crediminuto\Faq $Faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $array = json_decode(stripslashes($request->arrayId));

        if (!empty($array)) {
            $i = 1;
            foreach ($array as $items) {
                unset($data);
                $data = [
                    'orden' => $i
                ];
                $i++;

                Faq::where('id', '=', $items)->update($data);
            }

            return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS')]);

        } else {

            $faq = Faq::updateFaq($request);

            if ($faq) {
                return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' =>true]);
            }

            return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL')]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \Crediminuto\Faq $Faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faq = Faq::deleteFaq($request->id);

        if ($faq) {
            return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS_DELETE')]);
        }
        return response()->json(['status' => 'fail', 'alert' => env('MSJ_FAIL_DELETE')]);
    }

}
