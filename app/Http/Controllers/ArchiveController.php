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
        $book = $user->books()->where('id', $book_id)->get();

        //RETURN BOOK IF USER ISNT CHEATING
        if(count($book) != 0) 
        {   
            //GET BOOK FORMAT
            $fileName = explode('.', $book[0]->filename);
            $format = $fileName[1];

            //GENERATE NEW FILENAME
            $newName = $book[0]->name . ' - ' . $book[0]->author;
            //SET MAXIMUM GENERATED FILENAME LENGTH TO 80
            $newName = substr($newName, 0, 80);
            $newName = $newName . '.' . $format;

            //GET BOOK FILE PATH
            $path = 'books' . '/' . $book[0]->filename;

            return Storage::disk('private')->download($path, $newName); 
        }

        //ELSE RETURN WARNING ERROR
        else 
            return 'При нескольких попыток взлома ваш аккаунт будет заблокирован навсегда!';
    }

}
