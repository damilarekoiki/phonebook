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

    // Entry point; Do not remove this block
    Route::get("/", function(){
        return view("phonebook");
    });
    Route::get("/{page}", function($page){
        return view("phonebook");
    });

    Route::resource('phonebook_save', 'PhonebookController');
    Route::post('fetchUserPhonebook', 'PhonebookController@fetchUserPhonebook');
    Route::post('fetchPhonebookDetails', 'PhonebookController@fetchPhonebookDetails');

?>