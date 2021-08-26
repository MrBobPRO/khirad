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
        // return error if category with requested name already exists
        $exists = Category::where('name', $request->name)
        ->orwhere('latin_name', $this->transliterateIntoLatin($request->name))
        ->first();

        if($exists) return '<h1>Категория с таким названием уже существует. Пожалуйста поменяйте название !</h1>';

        Category::create([
            'name' => $request->name,
            'latin_name' => $this->transliterateIntoLatin($request->name),
            'description' => $request->description
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

        //-------------------check if category name changed start---------------------
        // return error if category with requested name already exists
        $new_name = $this->transliterateIntoLatin($request->name);
        if($category->latin_name != $new_name) {
            $exists = Category::where('name', $request->name)
            ->orwhere('latin_name', $new_name)
            ->first();

            if($exists) return '<h1>Категория с таким названием уже существует. Пожалуйста поменяйте название !</h1>';
        }
        //-------------------check if category name changed end---------------------

        $category->name = $request->name;
        $category->latin_name = $this->transliterateIntoLatin($request->name);
        $category->description = $request->description;
        $category->save();

        return redirect()->back();
    }

    //---------------------------------------------Webmaster Routes--------------------------------------------

    private function transliterateIntoLatin($string)
    {
        $cyr = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я', ' ',
            'ӣ', 'ӯ', 'ҳ', 'қ', 'ҷ', 'ғ', 'Ғ', 'Ӣ', 'Ӯ', 'Ҳ', 'Қ', 'Ҷ',
            '/', '\\', '|'
        ];

        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','shb','a','i','y','e','yu','ya',
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','shb','a','i','y','e','yu','ya', '_',
            'i', 'u', 'h', 'q', 'j', 'g', 'g', 'i', 'u', 'h', 'q', 'j',
            '_', '_', '_'
        ];
        //Trasilate url
        $transilation = str_replace($cyr, $lat, $string);

        //return lowercased url
        return strtolower($transilation);
    }

}
