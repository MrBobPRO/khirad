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
        $this->middleware('auth')->except('single', 'read');
    }

    public function all()
    {
        $books = Book::select('id', 'name', 'photo', 'latin_name')
                ->with(['authors' => function($query) {
                    $query->select('id', 'name'); }])
                ->latest()->paginate(40);

        return view('categories.single', compact('books'));
    }

    public function single($name)
    {
        $book = Book::where('latin_name', $name)->first();
        $reviews = Review::where('book_id', $book->id)->orderBy('updated_at', 'desc')->get();

        // FOR OPENGRAPH
        $shareText = $book->description;
        $shareText = mb_strlen($shareText) < 170 ? $shareText : mb_substr($shareText, 0, 166) . '...';

        return view('books.single', compact('book', 'reviews', 'shareText'));
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
        $book = Book::where('latin_name', $request->n)->first();
        $book->number_of_readings = $book->number_of_readings + 1;
        $book->save();
        // FOR OPENGRAPH
        $shareText = $book->description;
        $shareText = mb_strlen($shareText) < 170 ? $shareText : mb_substr($shareText, 0, 166) . '...';

        return view('books.read', compact('book', 'shareText'));
    }

}
