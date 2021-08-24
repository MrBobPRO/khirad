<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Image;

use function PHPUnit\Framework\fileExists;

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

        $categories = Category::orderBy('name', 'asc')->get();
        
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

        $categories = Category::orderBy('name', 'asc')->get();

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
        $book->language = $request->language;
        $book->price = $request->free ? 0 : $request->price;
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

        $book->name = $request->name;
        $book->isFree = $request->isFree;
        // $book->price = $request->isFree ? 0 : $request->price;
        // $book->discountPrice = $request->isFree ? 0 : $request->discountPrice;
        $book->price = 0;
        $book->discountPrice = 0;
        $book->description = $request->description;
        //needed in books with errors page
        if($request->file('book')) $book->filename = 'Ошибка';
        if($request->file('photo')) $book->photo = 'Ошибка';
        $book->publisher = $request->publisher;
        $book->year = $request->year;
        $book->pages = $request->pages;
        $book->isPopular = $request->isPopular;
        //only popular books display in main slider
        if($request->isPopular) {
            $book->txtColor = $request->txtColor;
            $book->bgColor = $request->bgColor;
            $book->btnColor = $request->btnColor;
        }
        $book->save();

        //only paidBooks have screenshots
        if(!$request->isFree) {
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
        }
        $book->save();

        $file = $request->file('book');
        if($file) {
            $filename = $book->id . '.' . $file->getClientOriginalExtension();
            //move book into public folder if its free
            if($book->isFree) $file->move(public_path('free_books'), $filename);
            //else move book into private folder
            else $file->storeAs('books', $filename, 'private'); 
            //change books filename in db
            $book->filename = $filename;
            $book->save();
        }

        //piece of book for paid books
        $piece = $request->file('piece');
        if($piece && $request->isFree == false) {
            $filename = $book->id . '.' . $piece->getClientOriginalExtension();
            //move book into public folder if its free
            $piece->move(public_path('free_books'), $filename);
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
            $thumb->save(public_path('img/thumbs/' . $photoName));

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
        $path = public_path('free_books/' . $book->filename);
        $storage_path = storage_path('app/private/books/'  . $book->filename);
        if($book->filename != '') {
            if (file_exists($path)) unlink($path);
            if (file_exists($storage_path)) unlink($storage_path);
        }

        //delete images
        $path = public_path('img/books/' . $book->photo);
        $thumb_path = public_path('img/thumbs/' . $book->photo);
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
            'ӣ', 'ӯ', 'ҳ', 'қ', 'ҷ', 'ғ', 'Ғ', 'Ӣ', 'Ӯ', 'Ҳ', 'Қ', 'Ҷ'
        ];

        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','shb','a','i','y','e','yu','ya',
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','shb','a','i','y','e','yu','ya', '_',
            'i', 'u', 'h', 'q', 'j', 'g', 'g', 'i', 'u', 'h', 'q', 'j'
        ];
        //Trasilate url
        $transilation = str_replace($cyr, $lat, $string);

        //return lowercased url
        return strtolower($transilation);
    }

}
