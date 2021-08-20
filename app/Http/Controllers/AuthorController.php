<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Image;

class AuthorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // ALL AUTHORS USED FOR SEARCH
        $allAuthors = Author::select('name', 'latin_name')
                            ->orderBy('name', 'asc')->get();

        $authors = Author::orderBy('foreign')->orderBy('name', 'asc')->paginate(40);

        //used to highlight active letter in alphabet (authors.by_letter route) 
        $letter = '0';

        $alphabet = ['а', 'б', 'в', 'г', 'ғ', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'ӣ', 'к', 'қ', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ӯ', 'ф', 'х', 'ҳ', 'ч', 'ҷ', 'ш', 'ъ', 'э', 'ю', 'я'];

        return view('authors.index', compact('authors', 'allAuthors', 'letter', 'alphabet'));
    }

    public function by_letter($letter)
    {
        // ALL AUTHORS USED FOR SEARCH
        $allAuthors = Author::select('name', 'latin_name')
                            ->orderBy('name', 'asc')->get();
                            
        $authors = Author::where('name', 'LIKE', $letter . '%')->orderBy('foreign')
                            ->orderBy('name', 'asc')
                            ->paginate(40);

        $alphabet = ['а', 'б', 'в', 'г', 'ғ', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'ӣ', 'к', 'қ', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ӯ', 'ф', 'х', 'ҳ', 'ч', 'ҷ', 'ш', 'ъ', 'э', 'ю', 'я'];

        return view('authors.index', compact('authors', 'allAuthors', 'letter', 'alphabet'));
    }

    public function popular()
    {
        // ALL AUTHORS USED FOR SEARCH
        $allAuthors = Author::where('popular', true)
                            ->select('name', 'latin_name')
                            ->orderBy('name', 'asc')->get();

        $authors = Author::where('popular', true)
                            ->select('name', 'photo', 'latin_name')
                            ->orderBy('name', 'asc')->paginate(40);

        return view('authors.popular', compact('authors', 'allAuthors'));
    }

    public function single($name)
    {
        $author = Author::where('latin_name', $name)->first();

        // FOR OPENGRAPH
        $shareText = $author->biography;
        $shareText = mb_strlen($shareText) < 170 ? $shareText : mb_substr($shareText, 0, 166) . '...';

        return view('authors.single', compact('author', 'shareText'));
    }


    //---------------------------------------Webmaster Routes------------------------------------------------
    public function webmaster_index()
    {
        $authors = Author::orderBy('name', 'asc')->paginate(40);
        $allAuthors = Author::select('id', 'name')
                    ->orderBy('name', 'asc')->get();
        $authorsCount = count($allAuthors);

        return view('webmaster.authors.index', compact('authors', 'allAuthors', 'authorsCount'));
    }

    public function webmaster_create()
    {
        return view('webmaster.authors.create');
    }

    public function webmaster_store(Request $request)
    {
        $author = Author::create([
            'name' => $request->name,
            'description' => $request->description,
            'isPopular' => $request->isPopular,
            'photo' => 'Ошибка'
        ]);

        $photo = $request->file('photo');
        $photoName = $author->id . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('img/authors'), $photoName);

        //create image thumb
        $thumb = Image::make(public_path('img/authors/' . $photoName));
        //Set image width 250 and height auto (saving ration)
        $thumb->resize(250, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        //save created image
        $thumb->save(public_path('img/authors/thumbs/' . $photoName));

        //change authors photo ib db
        $author->photo = $photoName;
        $author->save();

        return redirect()->route('webmaster.authors.index');

    }

    public function webmaster_single($id)
    {
        $author = Author::find($id);

        return view('webmaster.authors.single', compact('author'));
    }

    public function webmaster_update(Request $request)
    {
        $author = Author::find($request->id);
        $author->name = $request->name;
        $author->description = $request->description;
        $author->isPopular = $request->isPopular;
        $author->save();

        //authors photo
        $photo = $request->file('photo');
        if($photo) {
            $photoName = $author->id . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('img/authors'), $photoName);
    
            //create image thumb
            $thumb = Image::make(public_path('img/authors/' . $photoName));
            //Set image width 250 and height auto (saving ration)
            $thumb->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            //save created image
            $thumb->save(public_path('img/authors/thumbs/' . $photoName));
    
            //change authors photo ib db
            $author->photo = $photoName;
            $author->save();
        }

        return redirect()->back();
    }

    public function webmaster_remove(Request $request)
    {
        $author = Author::find($request->id);

        //delete images
        $path = public_path('img/authors/' . $author->photo);
        $thumb_path = public_path('img/authors/thumbs/' . $author->photo);
        if($author->photo != '') {
            if (file_exists($path)) unlink($path);
            if (file_exists($thumb_path)) unlink($thumb_path);
        }

        //delete authors books
        $author->books()->delete();

        //delete author from db
        $author->delete();

        return redirect()->route('webmaster.authors.index');
    }

    //---------------------------------------Webmaster Routes------------------------------------------------

}
