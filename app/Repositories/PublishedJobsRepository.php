<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\PublishedJobs;

class PublishedJobsRepository extends PublishedJobs
{

    public static function getMyPots($userId = null, $filterPost = null)
    {
        $query = PublishedJobs::join('companies', 'published_jobs.company_id', '=', 'companies.id')
            ->join('categories', 'published_jobs.category_id', '=', 'categories.id')
            ->join('countries', 'published_jobs.country_id', '=', 'countries.id')
            ->join('educations', 'published_jobs.education_id', '=', 'educations.id')
            ->select('published_jobs.*', 'published_jobs.id', 'companies.user_id', 'companies.user_id', 'companies.company_name', 'companies.company_logo', 'categories.category_name', 'countries.name', 'educations.education_name', 'companies.id AS id_company', 'companies.company_slug', 'companies.person_phone', 'companies.company_desciption');



        if (!empty($userId)) {
            $query->where('companies.user_id', '=', $userId);
        }

        if (isset($filterPost) and isset($filterPost['status'])) {
            $query->where('categories.category_status', '=', $filterPost['status']);
        }

        if (isset($filterPost) and isset($filterPost['id'])) {
            $query->where('published_jobs.id', '=', $filterPost['id']);
        }

        if (isset($filterPost) and isset($filterPost['search'])) {
            $query->where('published_jobs.job_title', 'LIKE', "%" . $filterPost['search'] . "%");
        }

        if (isset($filterPost) and isset($filterPost['category_id'])) {
            $query->where('published_jobs.category_id', '=', $filterPost['category_id']);
        }

        if (isset($filterPost) and isset($filterPost['category_panel'])) {
            $query->orWhere('published_jobs.category_id', '=', $filterPost['category_panel']);
        }

        if (isset($filterPost) and isset($filterPost['country_id'])) {
            $query->where('published_jobs.country_id', '=', $filterPost['country_id']);
        }

        if (isset($filterPost) and isset($filterPost['experience'])) {
            $query->where('published_jobs.year_of_experience', '=', $filterPost['experience']);
        }

        if (isset($filterPost) and isset($filterPost['gender'])) {
            $query->where('published_jobs.gender', 'LIKE', "%".$filterPost['gender']."%");
        }

        $query->orderBy('published_jobs.id', 'DESC');

        return $query;
    }


    public static function deletedPostCompany($id)
    {
        PublishedJobs::where('company_id', '=', $id)->delete();
    }


    public static function getCandidateApplications($id)
    {
        $query = Application::join('users', 'users.id', '=', 'applications.user_id')
            ->join('users_profiles', 'users.id', '=', 'users_profiles.user_id')
            ->join('countries', 'users_profiles.country_id', '=', 'countries.id')
            ->join('educations', 'users_profiles.education_id', '=', 'educations.id')
            ->select('applications.id', 'applications.published_jobs_id', 'applications.user_id', 'applications.created_at', 'applications.updated_at',
                'users.email', 'users_profiles.*', 'countries.name','educations.education_name')
            ->where('applications.published_jobs_id', '=', $id)
            ->orderBy('applications.published_jobs_id', 'DESC');

        return $query;
    }


}


