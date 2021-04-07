<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use App\Models\Book;
use App\Models\Author;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {

        Paginator::useBootstrap();

        \Schema::defaultStringLength(191);

        // SHARE DATA wITH ALL ROUTES (NAVBAR CATEGORIES)
        $navCats = Category::orderBy('name', 'asc')->get();
        View::share('navCats', $navCats);

        //Share all book names & author names for search
        view()->composer('templates.navbar', function ($view) {
            $view->with('allBooksNames', Book::orderBy('name', 'asc')->pluck('name'));
        });
        view()->composer('templates.navbar', function ($view) {
            $view->with('allAuthorsNames', Author::orderBy('name', 'asc')->pluck('name'));
        });

        //SHARE ROUTE NAME WITH ALL MASTER TEMPLATES
        view()->composer('templates.master', function ($view) {
            $view->with('route', \Route::currentRouteName());
        });

        view()->composer('books.master', function ($view) {
            $view->with('route', \Route::currentRouteName());
        });

        view()->composer('categories.master', function ($view) {
            $view->with('route', \Route::currentRouteName());
        });

        view()->composer('categories.single', function ($view) {
            $view->with('route', \Route::currentRouteName());
        });

        view()->composer('webmaster.master', function ($view) {
            $view->with('route', \Route::currentRouteName());
        });

    }
}
