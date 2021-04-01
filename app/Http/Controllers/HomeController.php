<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function __construct()
    {
        //remove in production
        $this->middleware('maintance');
    }


    public function index() {

        $latestBooks = Book::latest()->take(15)->get();
        $popularBooks = Book::where('isPopular', true)->inRandomOrder()->take(10)->get();
        $discountedBooks = Book::where('discountPrice', '!=', 0)->inRandomOrder()->take(7)->get();
        $topBooks = Book::orderBy('year', 'desc')->take(5)->get();
        $categories = Category::orderBy('name', 'asc')->get();

        return view('home.index', compact('latestBooks', 'popularBooks', 'discountedBooks', 'topBooks','categories'));
    }

    public function setLangTj() {

        session(['my_locale' => 'tj']);

        return redirect()->back();
    }
    
    public function setLangRu() {
        
        session(['my_locale' => 'ru']);

        return redirect()->back();
    }

    public function checkLogin(Request $request) {

        // check user locale and generate errorMSG
        $locale = \App::currentLocale();
        if($locale == 'ru') {
            $errorMsg = 'Неверный логин или пароль!';
        } else {
            $errorMsg = 'Почтаи электронӣ ё калиди нодуруст дохил карда шуд!';
        }

        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;

        //SIGN IN USER IF CREDENTIALS ARE VALID
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $request->session()->regenerate();

            return [
                'status' => 'success',
            ];

        //ELSE RETURN ERRORS
        } else {
            return [
                'status' => 'error',
                'error' => $errorMsg
            ];
        }
    }

    public function checkRegister(Request $request) {

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $pass_conf = $request->pass_conf;

        //CHECK IF NAME IS VALID. NAME MUST BE UNIQUE AND MIN 3 CHARS
        if(strlen($name) > 2)  {
            count(User::where('name', $name)->get()) == 0 ? $validName = true : $validName = false;
        } else $validName = false;

        //CHECK IF EMAIL IS VALID. EMAIL MUST BE UNIQUE
        $validEmailFormat = (filter_var($email, FILTER_VALIDATE_EMAIL));
        count(User::where('email', $email)->get()) == 0 ? $emailIsFree = true : $emailIsFree = false;

        //CHECK IF PASSWORD IS VALID. MIN 5 CHARS
        $password == $pass_conf ? $validPassConf = true : $validPassConf = false;
        strlen($password) > 4 ? $validPassLength = true : $validPassLength = false;

        //REGISTER AND SIGN IN USER IF CREDENTIALS ARE VALID
        if($validName && $validEmailFormat && $emailIsFree && $validPassConf && $validPassLength) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password)
            ]);

            Auth::attempt(['email' => $email, 'password' => $password], true);

            return [
                'status' => 'success',
            ];
        }

        //ELSE RETURN ERRORS
        else {

            // check user locale and generate errorMSG
            $locale = \App::currentLocale();
            $errors = [];
            $errorMsg = '';

            //PUSH ERRORS INTO MASSIVE FOR CHANGING ERROR FIELNDS BORDER INTO RED COLOR
            if(!$validName) {
                array_push($errors, 'name');
            }
            if(!$validEmailFormat) {
                array_push($errors, 'emailFormat');
            }
            if(!$emailIsFree) {
                array_push($errors, 'emailIsBusy');
            }
            if(!$validPassConf) {
                array_push($errors, 'passConf');
            }
            if(!$validPassLength) {
                array_push($errors, 'passLength');
            }

            //GENERATE ERROR MSG
            if($locale == 'ru') {
                if(!$validName) {
                    $errorMsg = $errorMsg . '&#x25B8; Пользователь с таким именем уже существует!<br>';
               }
               if(!$validEmailFormat) {
                    $errorMsg = $errorMsg . '&#x25B8; Неверный формат почты!<br>';
               }
               if(!$emailIsFree) {
                    $errorMsg = $errorMsg . '&#x25B8; Пользователь с такой электронной почтой уже существует!<br>';
               }
               if(!$validPassConf) {
                    $errorMsg = $errorMsg . '&#x25B8; Пароли не совпадают!<br>';
               }
               if(!$validPassLength) {
                    $errorMsg = $errorMsg . '&#x25B8; Пароль должен быть миннимум 5 символа!';
               }

            } else {
               if(!$validName) {
                    $errorMsg = $errorMsg . '&#x25B8; Корбар бо ин ном аллакай вуҷуд дорад!<br>';
               }
               if(!$validEmailFormat) {
                    $errorMsg = $errorMsg . '&#x25B8; Почтаи электронӣ ғалат дохил карда шуд!<br>';
               }
               if(!$emailIsFree) {
                    $errorMsg = $errorMsg . '&#x25B8; Корбар бо ин почтаи электронӣ аллакай вуҷуд дорад!<br>';
               }
               if(!$validPassConf) {
                    $errorMsg = $errorMsg . '&#x25B8; Калидҳо фарқ мекунанд!<br>';
               }
               if(!$validPassLength) {
                    $errorMsg = $errorMsg . '&#x25B8; Калид бояд аққалан аз 5 рамз иборат бошад!';
               }
            }


            return [
                'status' => 'error',
                'errorMsg' => $errorMsg,
                'errors' => $errors
            ];
        }
    }

}
