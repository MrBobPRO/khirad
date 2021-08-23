<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class CategoryController extends Controller
{

    public function __construct()
    {
        //webmaster routes
        $this->middleware('auth')->only(['webmaster_index', 'webmaster_single', 'webmaster_create', 'webmaster_store', 'webmaster_update']);
    }

    public function single($name, Request $request)
    {
        if($request->page && $request->page > 1) 
            $show_description = true;

        $category = Category::where('latin_name', $name)->first();
        $books = Book::whereHas('categories', function ($q) use ($name) {
                        $q->where('latin_name', $name); })
                    ->select('id', 'name', 'photo', 'latin_name')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->latest()
                    ->paginate(40);


        // FOR OPENGRAPH
        $shareText = $category->description;
        $shareText = mb_strlen($shareText) < 170 ? $shareText : mb_substr($shareText, 0, 166) . '...';

        return view('categories.single', compact('category', 'books', 'shareText'));
    }


    public function by_rating()
    {
        $books = Book::where('averageMark', '>=', 3.0)
                    ->select('id', 'name', 'photo', 'marksTemplate', 'marksCount', 'averageMark', 'latin_name')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->orderBy('averageMark', 'desc')
                    ->paginate(40);
        
        return view('categories.single', compact('books'));
    }


    public function world_most_readable()
    {
        $books = Book::where('most_readable', true)
                    ->select('id', 'name', 'photo', 'latin_name')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->orderBy('name', 'asc')
                    ->paginate(40);
        
        return view('categories.single', compact('books'));
    }


    public function site_most_readable()
    {
        $books = Book::where('number_of_readings', '>', 1)
                    ->select('id', 'name', 'photo', 'number_of_readings', 'latin_name')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->orderBy('number_of_readings', 'desc')
                    ->paginate(40);
        
        return view('categories.single', compact('books'));
    }

    public function foreign_books() {
        $books = Book::where('language', '!=', 'tj')
                    ->select('id', 'name', 'photo', 'latin_name')
                    ->with(['authors' => function($query) {
                        $query->select('id', 'name'); }])
                    ->latest()
                    ->paginate(40);

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
