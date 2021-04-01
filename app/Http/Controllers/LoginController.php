<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        //Remove in production
        $this->middleware('maintance')->except('store');
    }

    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if($user->isAdmin == '1') return redirect()->route('home');
            else return redirect()->back();

        } else return redirect()->back();
    }

}
