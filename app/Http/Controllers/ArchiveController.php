<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{

    public function __construct()
    {
        //Remove in production
        $this->middleware('maintance');
    }
    
    public function index() 
    {
        $user = Auth::user();
        //CASE USER IS GUEST RETURN NULL
        $books = null;
        //ELSE RETURN USERS BOOKS
        if($user)
            $books = $user->books()->orderBy('name', 'asc')->paginate(30);

        return view('archive.index', compact('books'));
    }

    public function download(Request $request) 
    {
        $book_id = $request->book_id;
        //CHECK IF USER IS NOT TRYING TO CHEAT
        $user = Auth::user();
        $book = $user->books()->where('id', $book_id)->first();

        //RETURN BOOK IF USER ISNT CHEATING
        if($book) 
        {   
            //GET BOOK FORMAT
            $fileName = explode('.', $book->filename);
            $format = $fileName[1];

            // GENERATE AUTHORS NAME AND CUT LAST ' & ' FROM STRING (LAST 3 SYMBOLS)
            $authors = '';
            foreach($book->authors as $author)
                $authors = $authors . $author->name . ' & ';
            $authors = substr($authors, 0, -3);

            //GENERATE NEW FILENAME
            $newName = $book->name . ' - ' . $authors;
            //SET MAXIMUM GENERATED FILENAME LENGTH TO 90
            $newName = substr($newName, 0, 90);
            $newName = $newName . '.' . $format;

            //GET BOOK FILE PATH
            $path = 'books' . '/' . $book->filename;

            return Storage::disk('private')->download($path, $newName); 
        }

        //ELSE RETURN WARNING ERROR
        else 
            return 'При нескольких попыток взлома ваш аккаунт будет заблокирован навсегда!';
    }

}
