<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Review;

class BookController extends Controller
{

    public function __construct()
    {
        //Remove in production
        $this->middleware('maintance');
    }

    public function all()
    {
        $books = Book::latest()->paginate(30);

        return view('categories.single', compact('books'));
    }

    public function single($id)
    {
        $book = Book::find($id);
        $reviews = Review::where('book_id', $book->id)->orderBy('updated_at', 'desc')->get();

        // CHECK IF USER HAS ALREADY MARKED THIS BOOK
        $auth = Auth::check();

        if ($auth) {
            $userId = Auth::id();
            // CHECK IF USER HAS ALREADY MARKED THIS BOOK
            $usersReview = Review::where('user_id', $userId)->where('book_id', $id)->get();

            // CHECK IF USER HAS ALREADY ADDED THIS BOOK INTO BASKET
            $basket = Auth::user()->basket->where('id', $id)->count();
            if ($basket > 0)
                $basketed = true;
            else
                $basketed = false;

            //CHECK IF USER HAS ALREADY OBTAINED THIS BOOK
            $obtainedBooks = Auth::user()->books->where('id', $id)->count();
            if ($obtainedBooks > 0)
                $obtained = true;
            else
                $obtained = false;
        } else {
            $usersReview = null;
            $basketed = false;
            $obtained = false;
        }

        return view('books.single', compact('book', 'usersReview', 'auth', 'reviews', 'basketed', 'obtained'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $category = $request->category;
        $year = $request->year;

        // IF ITS NAVBAR SEARCH (JUST BY KEYWORD)
        if (!$category && !$year) {
            $books = Book::whereHas('authors', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%");
            })

                ->orWhere(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('publisher', 'LIKE', "%{$keyword}%");
                })->get();

            $booksCount = count($books);

            return view('books.search', compact('books', 'booksCount', 'keyword'));
        }

        //ELSE IF ITS SEARCH BY CATEGORY YEAR AND KEYWORD
        // CASE CATEGORY IS GIVVEN 
        if ($category != 'all')
            $books = Book::whereHas('categories', function ($q) use ($category) {
                $q->where('id', $category);
            })
            
                ->where(function ($q) use ($keyword) {
                    $q->whereHas('authors', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', "%{$keyword}%");
                    })
                        ->orWhere(function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', "%{$keyword}%")
                                ->orWhere('description', 'LIKE', "%{$keyword}%")
                                ->orWhere('publisher', 'LIKE', "%{$keyword}%");
                        });
                })
                ->get();

        // CASE CATEGORY ALL SELECTED
        else
            $books = Book::whereHas('authors', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%");
            })

                ->orWhere(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('description', 'LIKE', "%{$keyword}%")
                        ->orWhere('publisher', 'LIKE', "%{$keyword}%");
                })->get();

        // CASE YEAR IS GIVVEN
        if ($year != 'all') {
            $books = $books->where('year', $year)->all();
        }

        $booksCount = count($books);

        return view('books.search', compact('books', 'booksCount', 'keyword'));
    }


    public function read(Request $request)
    {
        $book = Book::find($request->id);
        $filename = $book->filename;

        // RETURN ERROR CASE BOOK ISNT FREE
        if(!$book->isFree) return 'Доступ запрещён!';

        return view('books.read', compact('filename'));
    }

}
