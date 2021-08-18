<?php

namespace App\Http\Controllers;

class SecondaryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function questions()
    {
        return view('questions.index');
    }

    public function contacts()
    {
        return view('contacts.index');
    }
    
}
