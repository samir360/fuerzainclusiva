<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\PublishedJobs;

class AplicationRepository extends PublishedJobs
{

    public static function getMyAplications($userId = null)
    {

        $query = Application::join('published_jobs', 'applications.published_jobs_id', '=', 'published_jobs.id')
            ->join('companies', 'published_jobs.company_id', '=', 'companies.id')
            ->select('applications.id','applications.published_jobs_id','applications.user_id','applications.created_at','applications.updated_at','published_jobs.*','companies.company_logo','companies.company_slug');

        if (!empty($userId)) {
            $query->where('applications.user_id', '=', $userId);
        }

        $query->orderBy('applications.id', 'DESC');

        return $query;
    }

}


