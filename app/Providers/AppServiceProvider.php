<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

        Schema::defaultStringLength(191);

        //Share all book names & author names for search & share navbar categories
        view()->composer('templates.header', function ($view) {
            $appLocale = App::currentLocale();
            $navCats = Category::orderBy('name', 'asc')->get();

            $view->with('allBooksNames', Book::orderBy('name', 'asc')->pluck('name'))
            ->with('allAuthorsNames', Author::orderBy('name', 'asc')->pluck('name'))
            ->with('navCats', $navCats)
            ->with('appLocale', $appLocale)
            ->with('user', Auth::user());
        });

        //share route name
        view()->composer(['templates.styles', 'templates.scripts', 'webmaster.master'], function ($view) {
            $view->with('route', Route::currentRouteName());
        });

    }
}
