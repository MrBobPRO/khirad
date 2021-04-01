<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function __construct()
    {
        //Remove in production
        $this->middleware('maintance');
    }

    public function index()
    {
        // ALL AUTHORS USED FOR SEARCH
        $allAuthors = Author::orderBy('name', 'asc')->get();
        $authors = Author::orderBy('name', 'asc')->paginate(30);

        return view('authors.index', compact('authors', 'allAuthors'));
    }

    public function single($id)
    {
        $author = Author::find($id);

        return view('authors.single', compact('author'));
    }

    public function popular()
    {
        // ALL AUTHORS USED FOR SEARCH
        $allAuthors = Author::orderBy('name', 'asc')->get();
        $authors = Author::where('isPopular', '=', true)->paginate(30);

        return view('authors.index', compact('authors', 'allAuthors'));
    }
}
