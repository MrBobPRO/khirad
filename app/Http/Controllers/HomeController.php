<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {

        $latestBooks = Book::latest()->take(15)                                
                            ->select('id', 'name', 'photo')
                            ->with(['authors' => function($query) {
                                $query->select('id', 'name');
                            }])->get();

        $mostReadable = Book::where('most_readable', true)->inRandomOrder()->take(10)->get();

        $empfohlenBooks = Book::inRandomOrder()->take(7)
                                ->select('id', 'name', 'photo')
                                ->with(['authors' => function($query) {
                                    $query->select('id', 'name');
                                }])->get();

        $topBooks = Book::orderBy('number_of_readings', 'desc')->take(5)->get();

        $categories = Category::orderBy('name', 'asc')->get();

        return view('home.index', compact('latestBooks', 'mostReadable', 'empfohlenBooks', 'topBooks','categories'));
    }

}
