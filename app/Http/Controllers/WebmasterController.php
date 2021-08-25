<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Image;

class WebmasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $books = Book::latest()->paginate(40);
        //for search
        $allBooks = Book::select('id', 'name')
                        ->orderBy('name', 'asc')->get();

        $booksCount = count($allBooks);
        $erroredBooks = Book::where('filename', 'Ошибка')
            ->orWhere('photo', 'Ошибка')
            ->count();

        return view('webmaster.index', compact('books', 'booksCount', 'erroredBooks', 'allBooks'));
    }

    public function books_single($id)
    {
        $book = Book::find($id);
        $authors = Author::select('id', 'name')
                        ->orderBy('name', 'asc')->get();

        $categories = Category::select('id', 'name')
                        ->orderBy('name', 'asc')->get();
        
        return view('webmaster.books.single', compact('book', 'authors', 'categories'));
    }

    public function books_errors()
    {
        $books = Book::where('filename', 'Ошибка')
            ->orWhere('photo', 'Ошибка')
            ->latest()
            ->get();

        return view('webmaster.books.errors', compact('books'));
    }

    public function books_create()
    {
        $authors = Author::select('id', 'name')
                        ->orderBy('name', 'asc')->get();

        $categories = Category::select('id', 'name')
                        ->orderBy('name', 'asc')->get();

        return view('webmaster.books.create', compact('categories', 'authors'));
    }

    public function books_store(Request $request)
    {
        // return error if book with requested name already exists
        $exists = Book::where('name', $request->name)
                        ->orwhere('latin_name', $this->transliterateIntoLatin($request->name))
                        ->first();
        if($exists) return 'duplicate_name';

        $book = new Book;
        $book->name = $request->name;
        $book->latin_name = $this->transliterateIntoLatin($request->name);
        $book->free = $request->free;
        $book->price = $request->free ? 0 : $request->price;
        $book->language = $request->language;
        $book->description = $request->description;
        //needed in books with errors page
        $book->filename = 'Ошибка';
        $book->photo = 'Ошибка';
        $book->publisher = $request->publisher;
        $book->year = $request->year;
        $book->pages = $request->pages;
        $book->most_readable = $request->most_readable;
        //only most_readable books display in main slider
        if($request->most_readable) {
            $book->txtColor = $request->txtColor;
            $book->bgColor = $request->bgColor;
            $book->btnColor = $request->btnColor;
        }
        $book->save();

        //upload screenshots
        $sc1 = $request->file('screenshot1');
        if($sc1) {
            $sc1Filename = $book->id . 'a.' . $sc1->getClientOriginalExtension();
            $sc1->move(public_path('img/screenshots'), $sc1Filename);
            $book->screenshot1 = $sc1Filename;
        }

        $sc2 = $request->file('screenshot2');
        if($sc2) {
            $sc2Filename = $book->id . 'b.' . $sc2->getClientOriginalExtension();
            $sc2->move(public_path('img/screenshots'), $sc2Filename);
            $book->screenshot2 = $sc2Filename;
        }

        $sc3 = $request->file('screenshot3');
        if($sc3) {
            $sc3Filename = $book->id . 'c.' . $sc3->getClientOriginalExtension();
            $sc3->move(public_path('img/screenshots'), $sc3Filename);
            $book->screenshot3 = $sc3Filename;
        }

        //upload pdf file
        $file = $request->file('book');
        $filename = $book->latin_name . '.' . $file->getClientOriginalExtension();
        //move book into public folder if its free
        $file->move(public_path('books'), $filename);
        
        //change books filename in db
        $book->filename = $filename;
        $book->save();

        //books photo
        $photo = $request->file('photo');
        $photoName = $book->latin_name . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('img/books'), $photoName);

        //create image thumb
        $thumb = Image::make(public_path('img/books/' . $photoName));
        //Set image width 250 and height auto (saving ration)
        $thumb->resize(250, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        //save created image
        $thumb->save(public_path('img/books/thumbs/' . $photoName));

        //change books photo in db
        $book->photo = $photoName;
        $book->save();

        //Decode JSONed arrays and attach to the book
        $decodedAuthors = json_decode($request->encodedAuthors);
        $book->authors()->attach($decodedAuthors);

        $decodedCategories = json_decode($request->encodedCategories);
        $book->categories()->attach($decodedCategories);

        return route('webmaster.index');
    }


    public function books_update(Request $request)
    {
        $book = Book::find($request->id);

        //-------------------check if books name changed start---------------------
        // return error if book with requested name already exists
        $new_name = $this->transliterateIntoLatin($request->name);
        if($book->latin_name != $new_name) {
            $exists = Book::where('name', $request->name)
            ->orwhere('latin_name', $new_name)
            ->first();

            if($exists) return 'duplicate_name';

            else {
                //rename books photo and pdf files in explorer and database because of new name
                $public_path = public_path() . '/';
                //if new photo selected, books photo and photo_name in db will automatically change on upload
                if(!$request->file('photo')) {
                    $ext = pathinfo($public_path .'img/books/' . $book->photo , PATHINFO_EXTENSION);

                    if(file_exists($public_path .'img/books/' . $book->photo))
                        rename($public_path . 'img/books/' . $book->photo, $public_path . 'img/books/' . $new_name . '.' . $ext);
                        
                    if(file_exists($public_path . 'img/books/thumbs/' . $book->photo))
                        rename($public_path . 'img/books/thumbs/' . $book->photo, $public_path . 'img/books/thumbs/' . $new_name . '.' . $ext);

                    $book->photo = $new_name . '.' . $ext;
                    $book->save();
                }

                //if new pdf_file selected, books pdf_file and filename in db will automatically change on upload
                if(!$request->file('book')) {
                    $ext = pathinfo($public_path . 'books/' . $book->filename, PATHINFO_EXTENSION);

                    if(file_exists($public_path . 'books/' . $book->filename))
                        rename($public_path . 'books/' . $book->filename, $public_path . 'books/' . $new_name . '.' . $ext);

                    $book->filename = $new_name . '.' . $ext;
                    $book->save();
                }
            }
        }
        //-------------------check if books name changed end---------------------


        $book->name = $request->name;
        $book->latin_name = $this->transliterateIntoLatin($request->name);
        $book->free = $request->free;
        $book->price = $request->free ? 0 : $request->price;
        $book->language = $request->language;
        $book->description = $request->description;
        //needed in books with errors page
        if($request->file('book')) $book->filename = 'Ошибка';
        if($request->file('photo')) $book->photo = 'Ошибка';
        $book->publisher = $request->publisher;
        $book->year = $request->year;
        $book->pages = $request->pages;
        $book->most_readable = $request->most_readable;
        //only most_readable books display in main slider
        if($request->most_readable) {
            $book->txtColor = $request->txtColor;
            $book->bgColor = $request->bgColor;
            $book->btnColor = $request->btnColor;
        }
        $book->save();

        //upload screenshots
        $sc1 = $request->file('screenshot1');
        if($sc1) {
            $sc1Filename = $book->id . 'a.' . $sc1->getClientOriginalExtension();
            $sc1->move(public_path('img/screenshots'), $sc1Filename);
            $book->screenshot1 = $sc1Filename;
        }

        $sc2 = $request->file('screenshot2');
        if($sc2) {
            $sc2Filename = $book->id . 'b.' . $sc2->getClientOriginalExtension();
            $sc2->move(public_path('img/screenshots'), $sc2Filename);
            $book->screenshot2 = $sc2Filename;
        }

        $sc3 = $request->file('screenshot3');
        if($sc3) {
            $sc3Filename = $book->id . 'c.' . $sc3->getClientOriginalExtension();
            $sc3->move(public_path('img/screenshots'), $sc3Filename);
            $book->screenshot3 = $sc3Filename;
        }
        $book->save();


        //upload pdf file
        $file = $request->file('book');
        if($file) {
            $filename = $book->latin_name . '.' . $file->getClientOriginalExtension();
            //move book into public folder if its free
            $file->move(public_path('books'), $filename);
            
            //change books filename in db
            $book->filename = $filename;
            $book->save();
        }

        //books photo
        $photo = $request->file('photo');
        if($photo) {
            $photoName = $book->id . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('img/books'), $photoName);
    
            //create image thumb
            $thumb = Image::make(public_path('img/books/' . $photoName));
            //Set image width 250 and height auto (saving ration)
            $thumb->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            //save created image
            $thumb->save(public_path('img/books/thumbs/' . $photoName));
    
            //change books photo in db
            $book->photo = $photoName;
            $book->save();
        }

        //Decode JSONed arrays and attach to the book
        $book->authors()->detach();
        $decodedAuthors = json_decode($request->encodedAuthors);
        $book->authors()->attach($decodedAuthors);

        $book->categories()->detach();
        $decodedCategories = json_decode($request->encodedCategories);
        $book->categories()->attach($decodedCategories);

        return 'success';
    }

    public function books_remove(Request $request)
    {
        $book = Book::find($request->id);

        // delete files
        $path = public_path('books/' . $book->filename);
        if($book->filename != '') if (file_exists($path)) unlink($path);
        
        //delete images
        $path = public_path('img/books/' . $book->photo);
        $thumb_path = public_path('img/books/thumbs/' . $book->photo);
        if($book->photo != '') {
            if (file_exists($path)) unlink($path);
            if (file_exists($thumb_path)) unlink($thumb_path);
        }

        //delete screenshots
        $sc1 = public_path('img/screenshots/' . $book->screenshot1);
        if($book->screenshot1 != '') {
            if (file_exists($sc1)) unlink($sc1);
        }
        $sc2 = public_path('img/screenshots/' . $book->screenshot2);
        if($book->screenshot2 != '') {
            if (file_exists($sc2)) unlink($sc2);
        }
        $sc3 = public_path('img/screenshots/' . $book->screenshot3);
        if($book->screenshot3 != '') {
            if (file_exists($sc3)) unlink($sc3);
        }

        //delete book from db
        $book->delete();

        return redirect()->route('webmaster.index');
    }


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
