<?php

namespace App\Repositories;

use App\Models\StaticPage;

class StaticPageRepository extends StaticPage
{

    public static function getStaticPage($filter = null, $typeView = null)
    {
        $query = StaticPage::query();


        if (isset($filter) and !empty($filter['search'])) {
            $query->where('title', 'LIKE', '%' . $filter['search'] . '%');
        }

        if (isset($filter) and !empty($filter['status'])) {
            $query->where('status', '=', $filter['status']);
        }

        if (!empty($typeView)) {
            $query->where('type_view', '=', $typeView);
        }

        $query->orderBy('id', 'desc');;

        return $query;
    }
}


