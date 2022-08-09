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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);



// Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/recipe', 'RecipeController@index')->name('recipe');
    Route::get('/create', 'RecipeController@create')->name('recipe.create');
    Route::post('/store', 'RecipeController@store')->name('recipe.store');
    Route::get('/view/{id}', 'RecipeController@show')->name('recipe.view');
    Route::get('/edit/{id}', 'RecipeController@edit')->name('recipe.edit');
    Route::post('/update/{id}', 'RecipeController@update')->name('recipe.update');
});

