<?php

namespace App\Repositories;

use App\Models\Industry;

class IndustryRepository extends Industry
{

    public static function getInsdustries($filter=null)
    {
        $query = Industry::select('id', 'industry_name', 'industry_status', 'created_at');

        if(isset($filter) and !empty($filter['industry_name'])){
            $query->where('industry_name', '=', $filter['industry_name']);
        }

        if(isset($filter) and !empty($filter['search'])){
            $query->where('industry_name', 'LIKE', '%'.$filter['search'].'%');
        }

        if(isset($filter) and !empty($filter['status'])){
            $query->where('industry_status', '=', $filter['status']);
        }

        $query->orderBy('industry_name');

        return $query;
    }
}


