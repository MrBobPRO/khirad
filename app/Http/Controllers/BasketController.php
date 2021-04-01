<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{

    public function __construct()
    {
        //Remove in production
        $this->middleware('maintance');
    }

    public function index()
    {
        $books = null;
        $basketPrice = 0;
        $discountedPrice = 0;
        //GET USERS BASKETED BOOKS
        if(Auth::check()) 
        {
            $books = Auth::user()->basket;
            // COUNT TOTAL BOOKS PRICE AND DISCOUNTED PRICE
            foreach($books as $book) 
            {
                if($book->discountPrice != 0) 
                {
                    $basketPrice += $book->discountPrice;
                    $discountedPrice += $book->price - $book->discountPrice;
                }  else {
                    $basketPrice += $book->price;
                } 
            }
        }

        return view('basket.index', compact('books', 'basketPrice', 'discountedPrice'));
    }


    public function store(Request $request) 
    {
        Auth::user()->basket()->attach($request->book_id);

        return redirect()->back();
    }


    public function remove(Request $request) 
    {
        Auth::user()->basket()->detach($request->book_id);

        return redirect()->back();
    }

    public function empty()
    {
        Auth::user()->basket()->detach();

        return redirect()->back();
    }

}
