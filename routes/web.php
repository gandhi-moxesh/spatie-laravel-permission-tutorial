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

//vscode://vscode.github-authentication/did-authenticate?windowid=1&code=a7b1283b0ae06b95834a&state=bce2c467-9350-41ee-b86a-6daf2bc6054e

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts', 'HomeController@showPosts')->name('posts');
Route::get('/changeData', 'HomeController@changeData');
//role & permission based authentication
// Route::group(['middleware' => ['role:writer|admin','permission:write post']], function () {
//     Route::post('/addPosts', 'HomeController@addPosts');
//     Route::get('/addPostsForm', function () {
//         return view('post')->with('addPosts',"");
//     });
// });

// Route::group(['middleware' => ['role:editor|admin','permission:edit post']], function () {
//     Route::get('/editPostsForm/{id}', 'HomeController@editPostsFrom');
//     Route::post('/editPosts', 'HomeController@editPosts')->name('editPosts');
// });

// Route::group(['middleware' => ['role:publisher|admin','permission:publish post']], function () {
//     Route::get('/deletePosts/{id}', 'HomeController@deletePosts');
// });

//role based authentication
Route::group(['middleware' => ['role:writer|admin']], function () {
    Route::post('/addPosts', 'HomeController@addPosts');
    Route::get('/addPostsForm', function () {
        return view('post')->with('addPosts',"");
    });
});

Route::group(['middleware' => ['permission:edit post']], function () {
    Route::get('/editPostsForm/{id}', 'HomeController@editPostsFrom');
    Route::post('/editPosts', 'HomeController@editPosts')->name('editPosts');
});

Route::group(['middleware' => ['role:publisher|admin']], function () {
    Route::get('/deletePosts/{id}', 'HomeController@deletePosts');
});

//blade based authentication
// Route::post('/addPosts', 'HomeController@addPosts');
// Route::get('/addPostsForm', function () {
//     return view('post')->with('addPosts',"");
// });

// Route::get('/editPostsForm/{id}', 'HomeController@editPostsFrom');
// Route::post('/editPosts', 'HomeController@editPosts')->name('editPosts');

// Route::get('/deletePosts/{id}', 'HomeController@deletePosts');