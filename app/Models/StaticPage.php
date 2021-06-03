<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    const TERMS_AND_CONDITIONS='TERMINOS Y CONDICIONES';
    const PRIVACY_POLICIES='POLITICAS DE PRIVACIDAD';
    const THE_COMPANY='LA EMPRESA';
    const UNDERTAKES='EMPRENDE';
    const DID_YOU_KNOW='SABIAS QUE';


    const STATIC_PAGE_ACTIVE='ACTIVO';
    const STATIC_PAGE_INACTIVE='INACTIVO';


    public static function saveStaticPage($request)
    {
        $statictPage = new self();

        $statictPage->title = $request->title;
        $statictPage->sub_title = $request->sub_title;
        $statictPage->body = $request->body;
        $statictPage->type_view = $request->type_view;
        $statictPage->static_page_status = $request->static_page_status;
        $statictPage->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($statictPage, 'saveStaticPage', [
            'statictPage' => $statictPage
        ]);

        return $statictPage;
    }

    public static function updateStaticPage($request)
    {
        $obj = new self();
        $statictPage = $obj->find($request->id);

        $statictPage->title = $request->title;
        $statictPage->sub_title = $request->sub_title;
        $statictPage->body = $request->body;
        $statictPage->type_view = $request->type_view;
        $statictPage->static_page_status = $request->static_page_status;
        $statictPage->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($statictPage, 'updateStaticPage', [
            'statictPage' => $statictPage,
        ]);

        return $statictPage;
    }

    public static function deleteStaticPage($id)
    {
        $obj = new self();

        $staticPage=$obj->find($id);
        $obj->find($id)->delete();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($staticPage, 'deleteStaticPage', []);

        return $staticPage;
    }
}
