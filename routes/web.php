<?php

use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\Admin\NewsSourcesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\CategoriesController;
use App\Http\Controllers\News\NewsController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SocialProvidersController;
use \App\Http\Controllers\Admin\ParserController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/save', [HomeController::class, 'save'])->name('save');


Route::prefix('news')
    ->group(function () {
        Route::get('/categories', [CategoriesController::class, 'index'])
            ->name('news.categories');
        Route::get('/categories/{slug}', [CategoriesController::class, 'show'])
//    ->where('id', '[0-9]+')
            ->name('news.catsOne');
        Route::get('/news', [NewsController::class, 'index'])->name('news');
        Route::get('/{slug}/{id}', [NewsController::class, 'show'])
            ->where('category_id', '[0-9]+')
            ->where('id', '[0-9]+')
            ->name('news.show');
    });

Route::middleware('auth')->group(function () {
    Route::get('/account', AccountController::class)->name('account');
    Route::name('admin.')
        ->prefix('admin')
        ->middleware('is_admin')
//    ->namespace('Admin')
        ->group(function () {
            Route::get('/', [AdminIndexController::class, 'index'])->name('index');
            Route::resource('categories', AdminCategoriesController::class);
            Route::resource('news', AdminNewsController::class);
            Route::resource('news_sources', NewsSourcesController::class);
            Route::resource('users', UsersController::class);
            Route::get('/test1', [AdminIndexController::class, 'test1'])->name('test1');
            Route::match(['get', 'post'], '/test2', [AdminIndexController::class, 'test2'])->name('test2');
            Route::get('/parser', ParserController::class)->name('parser');
        });
});

Route::view('/about', 'about')->name('about');

Route::view('/auth', 'auth')->name('auth');



Auth::routes();

Route::group(['middleware' => 'guest'], function(){
    Route::get('/auth/redirect/{driver}', [SocialProvidersController::class, 'redirect'])
        ->name('social.auth.redirect');

    Route::get('/auth/callback/{driver}', [SocialProvidersController::class, 'callback']);
} );
