<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\EmailSendServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user();

        return view('frontend.contact', ['user' => $user]);
    }


    public function saveContact(Request $request)
    {
        Contact::saveContact($request);

        $objEmailSender = new EmailSendServices();

        #Envio de email al cliente
        $objEmailSender->sendEmailContacto($request);

        #Envio email soporte
        $objEmailSender->sendEmailSoporteContacto($request);

        return response()->json(['status' => 'success', 'alert' => env('MSJ_SUCCESS')]);
    }
}
