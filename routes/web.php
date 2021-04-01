<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
// CHANGE LANGUAGE ROUTES
Route::post('/setLangRu', 'HomeController@setLangRu');
Route::post('/setLangTj', 'HomeController@setLangTj');
// AJAX CHECK OF LOGIN/REGISTER FORMS
Route::post('/checkLogin', 'HomeController@checkLogin');
Route::post('/checkRegister', 'HomeController@checkRegister');
// SINGLE BOOK ROUTES
Route::get('/books/{id}', 'BookController@single')->name('books.single');
Route::post('/reviews-store', 'ReviewController@store');
Route::post('/reviews-edit', 'ReviewController@edit');

// FOR ALL BOOKS, DISCOUNTED BOOKS, POPULAR BOOKS, RATED BOOKS, FREE BOOKS, AND SINGLE CATEGORY BOOKS USED SAME VIEW AND STYLES
Route::get('/all_books', 'BookController@all')->name('books.all');
Route::get('/categories/{id}', 'CategoryController@single')->name('categories.single');
Route::get('/discounts', 'CategoryController@discounts')->name('categories.discounts');
Route::get('/popular_books', 'CategoryController@popular')->name('categories.popular');
Route::get('/books_by_rating', 'CategoryController@by_rating')->name('categories.rating');
Route::get('/bestsellers', 'CategoryController@bestsellers')->name('categories.bestsellers');
Route::get('/free-books', 'CategoryController@free')->name('categories.free');
// SEARCH STYLES AND VIEW ARE ALMOST SAME AS ALL BOOKS, DISCOUNTED BOOKS, POPULAR BOOKS, RATED BOOKS, FREE BOOKS,  AND SINGLE CATEGORY BOOKS
Route::get('/search', 'BookController@search')->name('books.search');

//READ BOOKS
Route::get('/read_book', 'BookController@read')->name('books.read');

//AUTGORS
Route::get('/authors', 'AuthorController@index')->name('authors');
Route::get('/popular_authors', 'AuthorController@popular')->name('authors.popular');
Route::get('/authors/{id}', 'AuthorController@single')->name('authors.single');

//ARCHIVE
Route::get('/archive', 'ArchiveController@index')->name('archive');
//ARCHIVE BOOKS DOWNLOAD
Route::post('/archive/download', 'ArchiveController@download');

//QUESTIONS-ANSWERS PAGE
Route::get('/questions', 'SecondaryController@questions')->name('questions');
//CONTACTS PAGE
Route::get('/contacts', 'SecondaryController@contacts')->name('contacts');

//BASKET PAGE
Route::get('/basket', 'BasketController@index')->name('basket');
Route::post('/add_into_basket', 'BasketController@store');
Route::post('/remove_from_basket', 'BasketController@remove');
Route::post('/empty_basket', 'BasketController@empty');
//CHEKOUT
Route::post('/checkout', 'CheckoutController@checkout');


//Webmaster
Route::get('/webmaster', 'WebmasterController@index')->name('webmaster.index');
Route::get('/webmaster/books/{id}', 'WebmasterController@books_single')->name('webmaster.books.single');
Route::get('/webmaster/books_create', 'WebmasterController@books_create')->name('webmaster.books.create');

Route::post('/books_store', 'WebmasterController@books_store');

//Remove in production
Route::get('/login', 'LoginController@index')->name('login');
Route::post('/auth', 'LoginController@store');

require __DIR__.'/auth.php';

