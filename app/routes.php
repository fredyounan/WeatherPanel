<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('before' => 'auth' ,function()
{
    return 'Hello, '.Auth::user()->username.'!';
}));


//Route::get('/', 'MainController@ShowMain');
Route::get('/login', function()
{
    return View::make('login');
});
Route::post('/login', function()
{
    Auth::attempt( array('username' => Input::get('username'), 'password' => Hash::make(Input::get('password'))) );

    return Redirect::to('/');
});