<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\EmailSendServices;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    #use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    #protected $redirectTo = RouteServiceProvider::HOME;


    public function showRegistrationForm()
    {
        return view('frontend.register');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = UserRepository::verifyUser(strtolower($request->email));

        if ($users instanceof User) {
            return response()->json(['status' => 'fail', 'alert' => 'La cuenta ya se entra registrada']);
        }

        $user = User::saveUser($request);

        Auth::login($user);

        $route = route('jobs');
        if ($user->rol_id == User::ROL_EMPLOYER) {
            $route = route('candidate');
        }

        $objEmailSender = new EmailSendServices();

        #Envio de email al cliente
        $objEmailSender->sendEmailRegister($request);

        #Envio email soporte
        $objEmailSender->sendEmailRegisterSoporteContacto($request);


        return response()->json(['status' => 'success', 'alert' => config('app.msj_success'), 'route' => $route]);
    }
}
