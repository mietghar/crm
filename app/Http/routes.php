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

//test routingu do walidacji formularzy
Route::get('cennik', 'Cennik\CennikController@index');
//Route::post('cennik', 'Cennik\CennikController@index');
Route::post('cennik', 'Cennik\CennikController@store');

//usuwanie pozycji z cennika
Route::get('cennik/usun','Cennik\CennikController@delete');
Route::get('cennik/usun/{id?}', ['uses'=>'Cennik\CennikController@destroy']);

//edytowanie pozycji z cennik
Route::get('cennik/edytuj','Cennik\CennikController@edit');
Route::get('cennik/edytuj/{id?}', ['uses'=>'Cennik\CennikController@update']);
Route::post('cennik_edytowano', 'Cennik\CennikController@updateTo');

Route::post('cennik_dodano', 'Cennik\CennikController@createNew');
Route::get('test','test\TestController@index');


/*
MODUŁ KONTAKTY
 *  */
//STRONA GŁÓWNA KONTAKTY
Route::get('kontakty','Kontakty\KontaktyController@index');
//widok firmy
Route::get('kontakty/firmy','Kontakty\KontaktyController@companiesShow');
//widok osoby
Route::get('kontakty/osoby','Kontakty\KontaktyController@personsShow');

//Route::get('/cennik/przeglad', function()
//{
//    $products = DB::table('products')->get();
//    return View::make('cennik.przeglad')->with('products',$products);
//});
Route::get('/cennik/przeglad', 'Cennik\CennikController@show');
Route::get('cennik/dodaj','Cennik\CennikController@create');
//Route::post('cennik/test', function()
//{
//    return 'udalo sie';
//}
//);
//Route::get('cennik/test', function()
//{
//    return 'udalo sie';
//}
//);


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);