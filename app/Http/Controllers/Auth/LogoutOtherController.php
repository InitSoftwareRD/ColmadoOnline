<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\validateCurrentPassword;

class LogoutOtherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('front.pages.change_password');
    }

    public function logoutOtherDevices(Request $request)
    {
        $request->validate([
            'password_current' =>  ['required', New validateCurrentPassword()],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->logoutOtherDevices($request->get('password'));

        return redirect()->back()->with(['success' => 'la contraseña ha sido cambiada correctamen.']);
    }
}
