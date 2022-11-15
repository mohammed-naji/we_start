<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $type = 'email';
        if(filter_var(request()->email, FILTER_VALIDATE_EMAIL)) {
            $type = 'email';
        }elseif(preg_match('/^[0-9]{10}+$/', request()->email)) {
            request()->merge(['phone' => request()->email]);
            $type = 'phone';
        }else {
            request()->merge(['username' => request()->email]);
            $type = 'username';
        }


        // dd(request()->all());
        return $type;
    }
}
