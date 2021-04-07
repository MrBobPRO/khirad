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
        //webmaster routes
        $this->middleware('webmaster')->only(['webmaster_index', 'webmaster_single', 'webmaster_create', 'webmaster_store', 'webmaster_update']);
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


    //---------------------------------------------Webmaster Routes--------------------------------------------
    public function webmaster_index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $categoriesCount = count($categories);

        return view('webmaster.categories.index', compact('categories', 'categoriesCount'));
    }

    public function webmaster_create()
    {
        return view('webmaster.categories.create');
    }

    public function webmaster_store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'russian_name' => $request->russian_name
        ]);

        return redirect()->route('webmaster.categories.index');

    }

    public function webmaster_single($id)
    {
        $category = Category::find($id);

        return view('webmaster.categories.single', compact('category'));
    }

    public function webmaster_update(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->russian_name = $request->russian_name;
        $category->save();

        return redirect()->back();
    }

    //---------------------------------------------Webmaster Routes--------------------------------------------

}
