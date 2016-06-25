<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');
Route::get('/', 'LoginController@index');

Route::get('home', 'HomeController@index');
Route::get('zarejestrowano','ZarejestrowanoController@index');
Route::get('cennik', 'Cennik\CennikController@index');
Route::get('test','test\TestController@index');
//Route::get('/cennik/przeglad/','Cennik\CennikController@show');
Route::get('/cennik/przeglad', function()
{
    $products = DB::table('products')->get();
    return View::make('cennik.przeglad')->with('products',$products);
}
    );
Route::get('cennik/dodaj','Cennik\CennikController@create');
Route::post('cennik/test', function()
{
    return 'udalo sie';
}
);
Route::get('cennik/test', function()
{
    return 'udalo sie';
}
);


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);