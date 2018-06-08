<?php

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

Route::get('/', 'FrontEndController@index')->name('index');
Route::get('/post/{slug}', 'FrontEndController@post')->name('single.post');
Route::get('/category/{id}', 'FrontEndController@category')->name('single.category');
Route::get('/tag/{id}', 'FrontEndController@tag')->name('single.tag');
Route::get('/results', 'FrontEndController@search')->name('search.result');

Route::post('/subscribe', 'NewslettersController@newsletter')->name('subscribe');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::group(['prefix' => 'admin'], function() {

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Category
        Route::group(['prefix' => 'categories'], function() {
            Route::get('/index', 'CategoriesController@index')->name('category.index');
            Route::get('/create', 'CategoriesController@create')->name('category.create');
            Route::get('/edit/{id}', 'CategoriesController@edit')->name('category.edit');
            Route::get('/remove/{id}', 'CategoriesController@destroy')->name('category.remove');
            Route::post('/store', 'CategoriesController@store')->name('category.store');
            Route::post('/update/{id}', 'CategoriesController@update')->name('category.update');
        });

        // Tags
        Route::group(['prefix' => 'tags'], function() {
            Route::get('/index', 'TagsController@index')->name('tag.index');
            Route::get('/create', 'TagsController@create')->name('tag.create');
            Route::get('/edit/{id}', 'TagsController@edit')->name('tag.edit');
            Route::get('/remove/{id}', 'TagsController@destroy')->name('tag.remove');
            Route::post('/store', 'TagsController@store')->name('tag.store');
            Route::post('/update/{id}', 'TagsController@update')->name('tag.update');
        });

        // Post
        Route::group(['prefix' => 'posts'], function() {
            Route::get('/index', 'PostsController@index')->name('post.index');
            Route::get('/create', 'PostsController@create')->name('post.create');
            Route::get('/edit/{id}', 'PostsController@edit')->name('post.edit');
            Route::get('/trash/{id}', 'PostsController@trash')->name('post.trash');
            Route::get('/trashed', 'PostsController@trashed')->name('post.trashed');
            Route::get('/restore/{id}', 'PostsController@restore')->name('post.restore');
            Route::get('/remove/{id}', 'PostsController@destroy')->name('post.remove');
            Route::post('/store', 'PostsController@store')->name('post.store');
            Route::post('/update/{id}', 'PostsController@update')->name('post.update');
        });

        // users
        Route::group(['prefix' => 'users'], function() {
            Route::get('/index', 'UsersController@index')->name('user.index');
            Route::get('/create', 'UsersController@create')->name('user.create');
            Route::get('/remove/{id}', 'UsersController@destroy')->name('user.remove');
            Route::get('/admin/{id}', 'UsersController@admin')->name('user.admin');
            Route::post('/store', 'UsersController@store')->name('user.store');
        });

        // profiles
        Route::group(['prefix' => 'profiles'], function() {
            Route::get('/index', 'ProfilesController@index')->name('profile.index');
            Route::post('/update', 'ProfilesController@update')->name('profile.update');
        });

        // settings
        Route::group(['prefix' => 'settings'], function() {
            Route::get('/index', 'SettingsController@index')->name('setting.index')->middleware('admin');
            Route::post('/update', 'SettingsController@update')->name('setting.update')->middleware('admin');
        });

    });
});