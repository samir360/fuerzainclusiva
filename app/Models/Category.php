<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const CATEGORY_ACTIVE = 'ACTIVO';
    const CATEGORY_INACTIVE = 'INACTIVO';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = "categories";


    public function jobs()
    {
        return $this->hasMany('App\Models\PublishedJobs');
    }


    public static function saveCategory($request)
    {
        $category = new self();

        $category->category_name = ucfirst(mb_strtolower($request->category_name));
        $category->category_status = $request->category_status;
        $category->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($category, 'saveCategory', [
            'category' => $category
        ]);

        return $category;
    }



    public static function updateCategory($request)
    {
        $obj = new self();
        $category = $obj->find($request->id);

        $category->category_name = ucfirst(mb_strtolower($request->category_name));
        $category->category_status = $request->category_status;
        $category->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($category, 'updateCategory', [
            'category' => $category
        ]);

        return $category;
    }



    public static function deleteCategory($id)
    {
        $category = self::find($id);
        self::find($id)->delete();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($category, 'deleteCategory', [
            'category' => $category
        ]);

        return $category;
    }
}