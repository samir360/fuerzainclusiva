<?php

namespace App\Repositories;

use App\Models\Faq;

class FaqRepository extends Faq
{

    public static function getFaqs($filter=null)
    {
        $query = Faq::query();

        if(isset($filter) and !empty($filter['question'])){
            $query->where('question', '=', $filter['question']);
        }

        if(isset($filter) and !empty($filter['search'])){
            $query->where('question', 'LIKE', '%'.$filter['search'].'%');
        }

        if(isset($filter) and !empty($filter['status'])){
            $query->where('faq_status', '=', $filter['status']);
        }

        $query->orderBy('orden');

        return $query;
    }
}


