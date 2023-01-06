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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

//Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
//    ->name('ckfinder_examples');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/change-profile', 'UserController@getProfile')->name('getProfile');
    Route::post('/change-profile', 'UserController@changeProfile')->name('changeProfile');
    Route::get('/change-password', 'UserController@changePassword')->name('changePassword');
    Route::post('/update-password', 'UserController@updatePassword')->name('updatePassword');

    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['permission:view_user']], function () {
        Route::get('', 'UserController@index')->name('index');
        Route::get('/create', 'UserController@create')->name('create')->middleware('permission:create_user');
        Route::post('/store', 'UserController@store')->name('store')->middleware('permission:create_user');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit')->middleware('permission:edit_user');
        Route::post('/update/{id}', 'UserController@update')->name('update')->middleware('permission:edit_user');
        Route::post('/destroy/{id}', 'UserController@destroy')->name('destroy')->middleware('permission:delete_user');
    });

    Route::group(['prefix' => 'roles', 'as' => 'roles.', 'middleware' => ['can:view_role']], function () {
        Route::get('', 'RoleController@index')->name('index');
        Route::get('/create', 'RoleController@create')->name('create')->middleware('permission:create_role');
        Route::post('/store', 'RoleController@store')->name('store')->middleware('permission:create_role');
        Route::get('/edit/{id}', 'RoleController@edit')->name('edit')->middleware('permission:edit_role');
        Route::post('/update/{id}', 'RoleController@update')->name('update')->middleware('permission:edit_role');
        Route::post('/destroy/{id}', 'RoleController@destroy')->name('destroy')->middleware('permission:delete_role');
    });

    Route::group(['prefix' => 'article', 'as' => 'article.', 'middleware' => ['permission:view_article']], function () {
        Route::get('', 'ArticleController@index')->name('index');
        Route::get('/create', 'ArticleController@create')->name('create')->middleware('permission:create_article');
        Route::post('/store', 'ArticleController@store')->name('store')->middleware('permission:create_article');
        Route::get('/edit/{id}', 'ArticleController@edit')->name('edit')->middleware('permission:edit_article');
        Route::post('/update/{id}', 'ArticleController@update')->name('update')->middleware('permission:edit_article');
        Route::post('/destroy/{id}', 'ArticleController@destroy')->name('destroy')->middleware('permission:delete_article');
    });

    Route::group(['prefix' => 'article-category', 'as' => 'article-category.', 'middleware' => ['permission:view_article']], function () {
        Route::get('', 'ArticleCategoryController@index')->name('index');
        Route::get('/create', 'ArticleCategoryController@create')->name('create')->middleware('permission:create_article');
        Route::post('/store', 'ArticleCategoryController@store')->name('store')->middleware('permission:create_article');
        Route::get('/edit/{id}', 'ArticleCategoryController@edit')->name('edit')->middleware('permission:edit_article');
        Route::post('/update/{id}', 'ArticleCategoryController@update')->name('update')->middleware('permission:edit_article');
        Route::post('/destroy/{id}', 'ArticleCategoryController@destroy')->name('destroy')->middleware('permission:delete_article');
    });

});


