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

// SINGLE BOOK ROUTES
Route::get('/book/{name}', 'BookController@single')->name('books.single');
Route::post('/reviews-store', 'ReviewController@store');
Route::post('/order_book', 'OrderController@create');

// FOR ALL BOOKS, DISCOUNTED BOOKS, POPULAR BOOKS, RATED BOOKS, FREE BOOKS, AND SINGLE CATEGORY BOOKS USED SAME VIEW AND STYLES
Route::get('/all_books', 'BookController@all')->name('books.all');
Route::get('/categories/{name}', 'CategoryController@single')->name('categories.single');
Route::get('/books_by_rating', 'CategoryController@by_rating')->name('categories.rating');
Route::get('/world_most_readable', 'CategoryController@world_most_readable')->name('categories.world_most_readable');
Route::get('/site_most_readable', 'CategoryController@site_most_readable')->name('categories.site_most_readable');
Route::get('/foreign_books', 'CategoryController@foreign_books')->name('categories.foreign_books');
// SEARCH STYLES AND VIEW ARE ALMOST SAME AS ALL BOOKS, BOOKS BY RATING, FOREIGN BOOKS ETC
Route::get('/search', 'BookController@search')->name('books.search');

//READ BOOKS
Route::get('/read_book', 'BookController@read')->name('books.read');

//AUTGORS
Route::get('/authors', 'AuthorController@index')->name('authors');
Route::get('/popular_authors', 'AuthorController@popular')->name('authors.popular');
Route::get('/authors/{name}', 'AuthorController@single')->name('authors.single');
Route::get('/authors/by_letter/{letter}', 'AuthorController@by_letter')->name('authors.by_letter');


//QUESTIONS-ANSWERS PAGE
Route::get('/questions', 'SecondaryController@questions')->name('questions');
//CONTACTS PAGE
Route::get('/contacts', 'SecondaryController@contacts')->name('contacts');


//--------------------------Webmaster Routes--------------------------------
// books
Route::get('/webmaster', 'WebmasterController@index')->name('webmaster.index');
Route::get('/webmaster/books/{id}', 'WebmasterController@books_single')->name('webmaster.books.single');
Route::get('/webmaster/books_create', 'WebmasterController@books_create')->name('webmaster.books.create');
Route::get('/webmaster/errors/books', 'WebmasterController@books_errors')->name('webmaster.books.errors');

Route::post('/books_store', 'WebmasterController@books_store');
Route::post('/books_update', 'WebmasterController@books_update');
Route::post('/books_remove', 'WebmasterController@books_remove');

//authors
Route::get('/webmaster/authors', 'AuthorController@webmaster_index')->name('webmaster.authors.index');
Route::get('/webmaster/authors/{id}', 'AuthorController@webmaster_single')->name('webmaster.authors.single');
Route::get('/webmaster/authors_create', 'AuthorController@webmaster_create')->name('webmaster.authors.create');

Route::post('/authors_store', 'AuthorController@webmaster_store');
Route::post('/authors_update', 'AuthorController@webmaster_update');
Route::post('/authors_remove', 'AuthorController@webmaster_remove');

//categories
Route::get('/webmaster/categories', 'CategoryController@webmaster_index')->name('webmaster.categories.index');
Route::get('/webmaster/categories/{id}', 'CategoryController@webmaster_single')->name('webmaster.categories.single');
Route::get('/webmaster/categories_create', 'CategoryController@webmaster_create')->name('webmaster.categories.create');

Route::post('/categories_store', 'CategoryController@webmaster_store');
Route::post('/categories_update', 'CategoryController@webmaster_update');

//Reviews
Route::get('/webmaster/reviews', 'ReviewController@webmaster_index')->name('webmaster.reviews.index');
Route::get('/webmaster/reviews/{id}', 'ReviewController@webmaster_single')->name('webmaster.reviews.single');

Route::post('/reviews_remove', 'ReviewController@webmaster_remove');

//Orders
Route::get('/webmaster/orders', 'OrderController@webmaster_index')->name('webmaster.orders.index');
Route::get('/webmaster/orders/{id}', 'OrderController@webmaster_single')->name('webmaster.orders.single');

Route::post('/orders_remove', 'OrderController@webmaster_remove');

//--------------------------Webmaster Routes--------------------------------

require __DIR__.'/auth.php';

