<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
   {

       if (auth()->user()->status == 'I'){
           abort(401, 'Su usuario ha sido desactivo.');

           auth()->logout();
       }

        else if (auth()->user()->isClient()) {
            return '/';
        }

        else if (auth()->user()->isAdmin()) {
            return '/admin/graficos';
        }

        else if (auth()->user()->isCajero()) {
            return '/admin/orden_status';
        }

        else if (auth()->user()->isDelivery()) {
            return '/admin/delivery';
        }
   }
}
