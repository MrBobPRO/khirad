<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class CategoryController extends Controller
{

    public function __construct()
    {
        //Remove in production
        $this->middleware('maintance');
    }

    public function single($id)
    {
        $category = Category::find($id);
        $books = Book::whereHas('categories', function($q) use ($id) {
            $q->where('id', $id); })
            ->latest()
            ->paginate(30);

        return view('categories.single', compact('category', 'books'));
    }

    public function discounts()
    {
        $books = Book::where('discountPrice', '!=', 0)->latest()->paginate(30);
        
        return view('categories.single', compact('books'));
    }

    public function popular()
    {
        $books = Book::where('isPopular', true)->latest()->paginate(30);
        
        return view('categories.single', compact('books'));
    }

    public function by_rating()
    {
        $books = Book::where('averageMark', '>=', 3.5)->orderBy('averageMark', 'desc')->paginate(30);
        
        return view('categories.single', compact('books'));
    }

    public function bestsellers()
    {
        $books = Book::where('sales', '>', 0)->orderBy('sales', 'desc')->paginate(30);
        
        return view('categories.single', compact('books'));
    }

    public function free()
    {
        $books = Book::where('isFree', '=', true)->latest()->paginate(30);
        
        return view('categories.single', compact('books'));
    }

}
