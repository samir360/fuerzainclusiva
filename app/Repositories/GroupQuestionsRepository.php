<?php

namespace App\Repositories;

use App\Models\GroupQuestions;

class GroupQuestionsRepository extends GroupQuestions
{

    public static function getGroupQuestions($filters = array())
    {
        $query = GroupQuestions::query();

        if (!empty($filters['status'])) {
            $query->where('status', '=', $filters['status']);
        }

        if (!empty($filters['group_name'])) {
            $query->where('group_name', 'LIKE', '%' . $filters['group_name'] . '%');
        }

        return $query->orderBy('orden', 'asc')->paginate(10);
    }
}


