<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends Category
{

    public static function getCategories($filter=null)
    {
        $query = Category::select('id', 'category_name', 'category_status', 'created_at');


        if(isset($filter) and !empty($filter['category_name'])){
            $query->where('category_name', '=', $filter['category_name']);
        }

        if(isset($filter) and !empty($filter['search'])){
            $query->where('category_name', 'LIKE', '%'.$filter['search'].'%');
        }

        if(isset($filter) and !empty($filter['status'])){
            $query->where('category_status', '=', $filter['status']);
        }

        $query->orderBy('category_name');


        return $query;
    }
}


