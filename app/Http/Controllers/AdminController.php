<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.layout.layout');
    }

    public function salir()
    {
        Auth::logout();
        
        return redirect()->route('inicioAdmin');
    }
}
