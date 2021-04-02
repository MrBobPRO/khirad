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
        $this->middleware('webmaster');
    }

    public function index()
    {
        $books = Book::latest()->paginate(20);
        $allBooks = Book::orderBy('name', 'asc')->get();
        $booksCount = count($allBooks);
        $erroredBooks = Book::where('filename', 'Ошибка')
            ->orWhere('photo', 'Ошибка')
            ->get();

        return view('webmaster.index', compact('books', 'booksCount', 'erroredBooks', 'allBooks'));
    }

    public function books_single($id)
    {
        $book = Book::find($id);
        $authors = Author::orderBy('name', 'asc')->get();
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
        $authors = Author::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('webmaster.books.create', compact('categories', 'authors'));
    }

    public function books_store(Request $request)
    {
        $book = new Book;
        $book->name = $request->name;
        $book->isFree = $request->isFree;
        $book->price = $request->isFree ? 0 : $request->price;
        $book->discountPrice = $request->isFree ? 0 : $request->discountPrice;
        $book->description = $request->description;
        //needed in books with errors page
        $book->filename = 'Ошибка';
        $book->photo = 'Ошибка';
        $book->description = $request->description;
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
            $sc1Filename = $book->id . 'a.' . $sc1->getClientOriginalExtension();
            $sc1->move(public_path('img/screenshots'), $sc1Filename);
            $sc2 = $request->file('screenshot2');
            $sc2Filename = $book->id . 'b.' . $sc2->getClientOriginalExtension();
            $sc2->move(public_path('img/screenshots'), $sc2Filename);
            $sc3 = $request->file('screenshot3');
            $sc3Filename = $book->id . 'c.' . $sc3->getClientOriginalExtension();
            $sc3->move(public_path('img/screenshots'), $sc3Filename);
            $book->screenshot1 = $sc1Filename;
            $book->screenshot2 = $sc2Filename;
            $book->screenshot3 = $sc3Filename;
        }

        $file = $request->file('book');
        $filename = $book->id . '.' . $file->getClientOriginalExtension();
        //move book into public folder if its free
        if($book->isFree) $file->move(public_path('free_books'), $filename);
        //else move book into private folder
        else $file->storeAs('books', $filename, 'private');
        //change books filename in db
        $book->filename = $filename;
        $book->save();

        //books photo
        $photo = $request->file('photo');
        $photoName = $book->id . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('img/books'), $photoName);

        //create image thumb
        $thumb = Image::make(public_path('img/books/' . $photoName));
        //Set image width 220 and height auto (saving ration)
        $thumb->resize(220, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        //save created image
        $thumb->save(public_path('img/thumbs/' . $photoName));

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
        $book->price = $request->isFree ? 0 : $request->price;
        $book->discountPrice = $request->isFree ? 0 : $request->discountPrice;
        $book->description = $request->description;
        //needed in books with errors page
        if($request->file('book')) $book->filename = 'Ошибка';
        if($request->file('photo')) $book->photo = 'Ошибка';
        $book->description = $request->description;
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


        //books photo
        $photo = $request->file('photo');
        if($photo) {
            $photoName = $book->id . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('img/books'), $photoName);

            //create image thumb
            $thumb = Image::make(public_path('img/books/' . $photoName));
            //Set image width 220 and height auto (saving ration)
            $thumb->resize(220, null, function ($constraint) {
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

        return route('webmaster.index');
    }

}
