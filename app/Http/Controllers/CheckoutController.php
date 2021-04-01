<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function __construct()
    {
        //Remove in production
        $this->middleware('maintance');
    }

    public function checkout()
    {
        // DISABLE ERRORS
        if(!Auth::check()) return redirect()->back();
        else if(Auth::check() && count(Auth::user()->basket) == 0) return redirect()->back();

        $user = Auth::user();

        foreach($user->basket as $book) 
            //ADD BOOKS INTO USERS ARCHIVE
            $user->books()->attach($book->id);

        //EMPTY USERS BASKET
        $user->basket()->detach();

        return redirect()->back();
    }
}
