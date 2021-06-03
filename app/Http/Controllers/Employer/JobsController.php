<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;

use App\Models\Application;
use App\Models\Category;
use App\Models\Country;
use App\Models\PublishedJobs;
use App\Repositories\CategoryRepository;
use App\Repositories\PublishedJobsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class JobsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $filter = ['status' => Category::CATEGORY_ACTIVE];

        $categories = CategoryRepository::getCategories($filter)->get();

        $filterPost = ['status' => PublishedJobs::JOB_ACTIVE];

        $jobs = PublishedJobsRepository::getMyPots(null, $filterPost)->paginate(10);

        $countries = Country::query()->orderBy('name', 'ASC')->get();

        return view('frontend.employer.index', ['user' => $user, 'categories' => $categories, 'jobs' => $jobs, 'countries' => $countries]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->country_id) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor seleccione una provincia']);
        }

        PublishedJobs::saveJob($request);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS')]);
    }


    public function update(Request $request)
    {
        if (!$request->country_id) {
            return response()->json(['status' => 'fail', 'alert' => 'Por favor seleccione una provincia']);
        }

        PublishedJobs::updateJob($request);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS'), 'edit' => true]);
    }


    public function myPosts()
    {
        $user = Auth::user();

        $myPosts = PublishedJobsRepository::getMyPots($user->id, null)->get();

        return view('frontend.employer.my-posts', ['user' => $user, 'myPosts' => $myPosts])->withErrors('Oops! no existe registro para mostrar');
    }


    public function postDeleted(Request $request)
    {
        PublishedJobs::deletedJob($request->id);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS')]);
    }


    public function jobLists(Request $request)
    {
        $user = Auth::user();

        $filterJobs = $request->filter;

        $jobs = PublishedJobsRepository::getMyPots(null, $filterJobs)->paginate(10);

        $filter = ['status' => Category::CATEGORY_ACTIVE];

        $categories = CategoryRepository::getCategories($filter)->get();

        $countries = Country::query()->orderBy('name', 'ASC')->get();

        return view('frontend.employer.job-list', [
            'user' => $user,
            'jobs' => $jobs,
            'categories' => $categories,
            'countries' => $countries,
            'filterJobs' => $filterJobs
        ])->withErrors('Oops! no existe registro para mostrar');
    }


    public function jobDetail($slug)
    {
        $user = Auth::user();

        $id = explode("-", Crypt::decryptString($slug));

        $filterJobs = ['id' => end($id)];

        $job = PublishedJobsRepository::getMyPots(null, $filterJobs)->first();


        $filter = ['status' => Category::CATEGORY_ACTIVE];

        $categories = CategoryRepository::getCategories($filter)->get();

        $countries = Country::query()->orderBy('name', 'ASC')->get();

        $application=$user->applications()->where('published_jobs_id', '=', $job->id)->first();

        return view('frontend.employer.job-detail', [
            'user' => $user,
            'job' => $job,
            'categories' => $categories,
            'countries' => $countries,
            'filterJobs' => $filterJobs,
            'application' => $application
        ])->withErrors('Oops! no existe registro para mostrar');
    }



    public function candidateApplications($id)
    {
        $user = Auth::user();

        $id = explode("-", Crypt::decryptString($id));

        $candidates=PublishedJobsRepository::getCandidateApplications(end($id))->paginate(12);

        $PublishedJob=PublishedJobs::where('id', '=', end($id))->first();

        return view('frontend.employer.candidate-applications', [
            'user' => $user,
            'candidates' => $candidates,
            'PublishedJob' => $PublishedJob,
        ])->withErrors('Oops! no existe registro para mostrar');
    }

}
