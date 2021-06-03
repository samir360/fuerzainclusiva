<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);


        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $data = array('error_time' => 1);
            return json_encode($data);
        }

        if ($this->attemptLogin($request)) {
            $this->incrementLoginAttempts($request);

            $user = Auth::user();
            $route = route('jobs');
            if ($user->rol_id == User::ROL_EMPLOYER) {
                $route = route('candidate');
            }

            return response()->json(['status' => 'success', 'route' => $route]);
        }

        if ($request->loginFront) {
            return response()->json(['status' => 'fail', 'alert' => 'Error datos son inválido']);
        }

        return response()->json(['status' => 'fail', 'alert' => 'Error datos son inválido']);
    }

    public function showHomeFrmLogin()
    {
       return redirect()->route('login-user');
    }

    public function showFrmLogin()
    {
        return view('frontend.login-user');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login-user');
    }
}
