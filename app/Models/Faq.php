<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    const FAQ_ACTIVE = 'ACTIVO';
    const FAQ_INACTIVE = 'INACTIVO';


    public static function saveFaq($request)
    {
        $faq = new self();

        $dataOrden = Faq::max('orden');
        $nOrden = $dataOrden + 1;

        $faq->question = ucfirst(mb_strtolower($request->question));
        $faq->faq_status = $request->faq_status;
        $faq->answer = $request->answer;
        $faq->orden = $nOrden;
        $faq->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($faq, 'saveFaq', [
            'faq' => $faq,
        ]);
        return $faq;
    }

    public static function updateFaq($request)
    {
        $obj = new self();
        $faq = $obj->find($request->id);

        $faq->question = ucfirst(mb_strtolower($request->question));
        $faq->faq_status = $request->faq_status;
        $faq->answer = $request->answer;
        $faq->save();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($faq, 'updateFaq', [
            'faq' => $faq
        ]);

        return $faq;
    }

    public static function deleteFaq($id)
    {
        $obj = new self();

        $faq = $obj->find($id);
        $obj->find($id)->delete();

        #Guardamos en Activity Log
        ActivityLog::saveActivityLog($faq, 'deleteFaq', []);

        return $faq;
    }
}
