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
        // $books = Book::whereHas('categories', function($q) use ($id) {
        //     $q->where('id', $id); })
        //     ->latest()
        //     ->paginate(30);

        $books = $category->books()
                    ->select('id', 'name', 'photo')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->latest()
                    ->paginate(30);

        return view('categories.single', compact('category', 'books'));
    }

    public function discounts()
    {
        $books = Book::where('discountPrice', '!=', 0)
                    ->select('id', 'name', 'photo')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->latest()
                    ->paginate(30);
        
        return view('categories.single', compact('books'));
    }

    public function popular()
    {
        $books = Book::where('isPopular', true)
                ->select('id', 'name', 'photo')
                ->with(['authors' => function($query) {
                    $query->select('id', 'name'); }])
                ->latest()
                ->paginate(30);
        
        return view('categories.single', compact('books'));
    }

    public function by_rating()
    {
        $books = Book::where('averageMark', '>=', 3.5)
                    ->select('id', 'name', 'photo', 'marksTemplate', 'marksCount', 'averageMark')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->orderBy('averageMark', 'desc')
                    ->paginate(30);
        
        return view('categories.single', compact('books'));
    }

    public function bestsellers()
    {
        $books = Book::where('sales', '>', 20)
                    ->select('id', 'name', 'photo', 'sales')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->orderBy('sales', 'desc')->paginate(30);
        
        return view('categories.single', compact('books'));
    }

    public function free()
    {
        $books = Book::where('isFree', '=', true)
                    ->select('id', 'name', 'photo')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->paginate(30);
        
        return view('categories.single', compact('books'));
    }


    //---------------------------------------------Webmaster Routes--------------------------------------------
    public function webmaster_index()
    {
        $categories = Category::orderBy('tjName', 'asc')->get();
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
            'tjName' => $request->tjName,
            'ruName' => $request->ruName
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
        $category->tjName = $request->tjName;
        $category->ruName = $request->ruName;
        $category->save();

        return redirect()->back();
    }

    //---------------------------------------------Webmaster Routes--------------------------------------------

}
