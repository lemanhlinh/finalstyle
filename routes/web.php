<?php
# @Author: Manh Linh
# @Date:   2023-01-01T17:33:09+07:00
# @Email:  lemanhlinh209@gmail.com
# @Last modified by:   Manh Linh
# @Last modified time: 2023-01-01T16:49:02+07:00
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::group(['namespace' => 'Web'], function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/gioi-thieu', 'HomeController@getContent')->name('getContent');
    Route::get('/thiet-ke-app', 'HomeController@getContentApp')->name('getContentApp');
    Route::get('/tin-cong-nghe', 'ArticleController@index')->name('homeArticle');
    Route::get('/danh-muc-tin/{slug}', 'ArticleController@cat')->name('catArticle');
    Route::get('/chi-tiet-tin/{slug}/{id}', 'ArticleController@detail')->name('detailArticle');
    Route::get('/lien-he', 'ContactController@index')->name('detailContact');
    Route::post('/lien-he', 'ContactController@store')->name('detailContactStore');
});

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

//Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
//    ->name('ckfinder_examples');

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

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
        Route::post('/update-tree', 'ArticleCategoryController@updateTree')->name('updateTree')->middleware('permission:edit_article');
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'middleware' => ['permission:view_article']], function () {
        Route::get('', 'SettingController@index')->name('index');
        Route::get('/create', 'SettingController@create')->name('create')->middleware('permission:create_article');
        Route::post('/store', 'SettingController@store')->name('store')->middleware('permission:create_article');
        Route::get('/edit/{id}', 'SettingController@edit')->name('edit')->middleware('permission:edit_article');
        Route::post('/update/{id}', 'SettingController@update')->name('update')->middleware('permission:edit_article');
        Route::post('/destroy/{id}', 'SettingController@destroy')->name('destroy')->middleware('permission:delete_article');
    });

    Route::group(['prefix' => 'contact', 'as' => 'contact.', 'middleware' => ['permission:view_article']], function () {
        Route::get('', 'ContactController@index')->name('index');
    });

    Route::group(['prefix' => 'menu-category', 'as' => 'menu-category.', 'middleware' => ['permission:view_article']], function () {
        Route::get('', 'MenuCategoryController@index')->name('index');
        Route::get('/create', 'MenuCategoryController@create')->name('create')->middleware('permission:create_article');
        Route::post('/store', 'MenuCategoryController@store')->name('store')->middleware('permission:create_article');
        Route::get('/edit/{id}', 'MenuCategoryController@edit')->name('edit')->middleware('permission:edit_article');
        Route::post('/update/{id}', 'MenuCategoryController@update')->name('update')->middleware('permission:edit_article');
        Route::post('/destroy/{id}', 'MenuCategoryController@destroy')->name('destroy')->middleware('permission:delete_article');
        Route::post('/update-tree', 'MenuCategoryController@updateTree')->name('updateTree')->middleware('permission:edit_article');
    });


    Route::group(['prefix' => 'menu', 'as' => 'menu.', 'middleware' => ['permission:view_article']], function () {
        Route::get('', 'MenuController@index')->name('index');
        Route::get('/create', 'MenuController@create')->name('create')->middleware('permission:create_article');
        Route::post('/store', 'MenuController@store')->name('store')->middleware('permission:create_article');
        Route::get('/edit/{id}', 'MenuController@edit')->name('edit')->middleware('permission:edit_article');
        Route::post('/update/{id}', 'MenuController@update')->name('update')->middleware('permission:edit_article');
        Route::post('/destroy/{id}', 'MenuController@destroy')->name('destroy')->middleware('permission:delete_article');
        Route::post('/update-tree', 'MenuController@updateTree')->name('updateTree')->middleware('permission:edit_article');
    });

});


