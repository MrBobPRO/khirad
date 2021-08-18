<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Request $request)
    {
        //FOR SECURE REASONS
        $mark = $request->mark;
        if($mark == 0) $mark == 1;

        Review::create([
            'user_name' => $request->user_name,
            'book_id' => $request->book_id,
            'mark' => $mark,
            'body' => $request->body
        ]);

        //INCREMENT BOOK MARKS COUNT
        $book = Book::find($request->book_id);
        $book->marksCount = $book->marksCount + 1;
        $book->save();
        //REGENERATE AVERAGE TOTAL MARK
        $this->regenerateAverageMark($book->id);


        return redirect()->back();
    }

    //REGENERATE AVERAGE TOTAL MARK, AFTER REVIEW CREATE OR EDIT
    private function regenerateAverageMark($book_id)
    {
        $book = Book::find($book_id);
        $averageMark = 0;
        $marksTemplate = '0';

        //COUNT AVERAGE TOTAL MARK
        foreach($book->reviews as $review) {
            $averageMark += $review->mark;
        }
        if($averageMark > 0) $averageMark /= $book->marksCount;
        //SET NEW VALUE FOR AVERAGE MARK
        $book->averageMark = $averageMark;

        //ROUND AVERAGE TOTAL MARK FOR MARK TEMPLATE (LARAVEL BLADE) 
        if($averageMark >=1 && $averageMark < 1.5) $marksTemplate = '1';
        else if($averageMark >= 1.5 && $averageMark < 2) $marksTemplate = '1,5';
        else if($averageMark >= 2 && $averageMark < 2.5) $marksTemplate = '2';
        else if($averageMark >= 2.5 && $averageMark < 3) $marksTemplate = '2,5';
        else if($averageMark >= 3 && $averageMark < 3.5) $marksTemplate = '3';
        else if($averageMark >= 3.5 && $averageMark < 4) $marksTemplate = '3,5';
        else if($averageMark >= 4 && $averageMark < 4.5) $marksTemplate = '4';
        else if($averageMark >= 4.5 && $averageMark < 5) $marksTemplate = '4,5';
        else if($averageMark == 5) $marksTemplate = '4,5';

        //SET NEW VALUE FOR MAKRS TEMPLATE
        $book->marksTemplate = $marksTemplate;

        $book->save();
    }
}
