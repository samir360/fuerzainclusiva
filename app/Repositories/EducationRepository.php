<?php

namespace App\Repositories;

use App\Models\Education;

class EducationRepository extends Education
{

    public static function getEducations($filter=null)
    {
        $query = Education::select('id', 'education_name', 'education_status', 'created_at');


        if(isset($filter) and !empty($filter['education_name'])){
            $query->where('education_name', '=', $filter['education_name']);
        }

        if(isset($filter) and !empty($filter['search'])){
            $query->where('education_name', 'LIKE', '%'.$filter['search'].'%');
        }

        if(isset($filter) and !empty($filter['status'])){
            $query->where('education_status', '=', $filter['status']);
        }

        $query->orderBy('education_name');


        return $query;
    }
}


