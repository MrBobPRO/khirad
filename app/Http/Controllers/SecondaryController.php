<?php

namespace App\Http\Controllers;

class SecondaryController extends Controller
{

    public function __construct()
    {
        //Remove in production
        $this->middleware('maintance');
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
