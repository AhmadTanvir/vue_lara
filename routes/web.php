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

Route::get('/', function () {
    return view('public/index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/category-list', 'HomeController@index')->name('category-list');
Route::get('/post-list', 'HomeController@index')->name('post-list');
Route::get('/add-post', 'HomeController@index')->name('add-post');
Route::get('/blog', 'BlogController@get_all_blog_post')->name('blog');
Route::get('/edit-category/{id}', 'HomeController@index')->name('edit-category');
Route::get('invoice', function() {
    return view('invoice');
})->name('invoice');

// Route::get('post', 'PostController@all_post')->name('post');
// Route::get('{path}', "HomeController@index")->where('path', '.*');

// Route::get('{path}', "HomeController@index")->where('path', '([A-z\d-\/_.]+)?');

Route::group(['middleware' => ['auth']], function() {
    //Category Routes
Route::post('/add-category', 'CategoryController@add_category');
Route::get('category', 'CategoryController@all_category');
Route::get('category/{id}', 'CategoryController@delete_category');
Route::get('editcategory/{id}', 'CategoryController@edit_category');
Route::post('update-category/{id}', 'CategoryController@update_category');
Route::get('/deletecategory/{id}', 'CategoryController@selected_category');
//Post Routes
Route::get('/post', 'PostController@all_post');
Route::post('/add-post', 'PostController@save_post');
Route::get('/delete/{id}', 'PostController@delete_post');
Route::get('/post/{id}', 'PostController@edit_post');
Route::post('/update/{id}', 'PostController@update_post');
});


Route::get('/blogpost', 'BlogController@get_all_blog_post');
Route::get('/singlepost/{id}', 'BlogController@get_post_by_id');
Route::get('/categories', 'BlogController@get_all_category');
Route::get('/categorypost/{id}', 'BlogController@get_all_post_by_cat_id');

Route::get('/search', 'BlogController@search_post');
Route::get('/latestpost', 'BlogController@latest_post');








