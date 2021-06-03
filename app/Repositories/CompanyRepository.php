<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository extends Company
{

    public static function getCompanies($filter=null)
    {
        $query = Company::query();

        if(isset($filter) and !empty($filter['user_id'])){
            $query->where('user_id', '=', $filter['user_id']);
        }

        if(isset($filter) and !empty($filter['search'])){
            $query->where('industry_name', 'LIKE', '%'.$filter['search'].'%');
        }

        if(isset($filter) and !empty($filter['company_name'])){
            $query->where('company_name', '=', $filter['company_name']);
        }

        if(isset($filter) and !empty($filter['status'])){
            $query->where('company_status', '=', $filter['status']);
        }

        $query->orderBy('company_name');

        return $query;
    }
}


