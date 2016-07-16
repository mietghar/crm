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


/*
MODUŁ CENNIKA
 *  */
//test routingu do walidacji formularzy
Route::get('cennik', 'Cennik\CennikController@index');
//Route::post('cennik', 'Cennik\CennikController@index');
Route::post('cennik', 'Cennik\CennikController@store');
//usuwanie kategorii z cennika
Route::get('cennik/usun_kategorie','Cennik\CennikController@deleteCategory');
Route::get('cennik/usun_kategorie/{id?}', ['uses'=>'Cennik\CennikController@destroyCategory']);
//usuwanie pozycji z cennika
Route::get('cennik/usun','Cennik\CennikController@delete');
Route::get('cennik/usun/{id?}', ['uses'=>'Cennik\CennikController@destroy']);

//edytowanie pozycji z cennika
Route::get('cennik/edytuj','Cennik\CennikController@edit');
Route::get('cennik/edytuj/{id?}', ['uses'=>'Cennik\CennikController@update']);
Route::post('cennik_edytowano', 'Cennik\CennikController@updateTo');
//edytowanie kategorii z cennika
Route::get('cennik/edytuj_kategorie','Cennik\CennikController@editCategory');
Route::get('cennik/edytuj_kategorie/{id?}', ['uses'=>'Cennik\CennikController@updateCategory']);
Route::post('cennik_edytowano_kategorie', 'Cennik\CennikController@updateToCategory');
//dodawanie kategorii do cennika
Route::post('kategoria_dodano', 'Cennik\CennikController@createNewCategory');
//dodawanie pozycji do cennika
Route::post('cennik_dodano', 'Cennik\CennikController@createNew');
Route::get('test','test\TestController@index');
//widok kroku 1 generowania oferty
Route::get('cennik/oferta1/{id?}',['uses'=>'Cennik\OfertaController@krok1']);
//widok kroku 2 generowania oferty
Route::post('oferta_wyslano', 'Cennik\OfertaController@krok2');
//generowanie widoku oferty
Route::get('cennik/oferty','Cennik\OfertaController@ofertyShow');


/*
MODUŁ KONTAKTY
 *  */
//STRONA GŁÓWNA KONTAKTY
Route::get('kontakty','Kontakty\KontaktyController@index');
//widok "firmy"
Route::get('kontakty/firmy','Kontakty\KontaktyController@companiesShow');
//widok "osoby"
Route::get('kontakty/osoby','Kontakty\KontaktyController@personsShow');
//widok "ulubione"
Route::get('kontakty/ulubione','Kontakty\KontaktyController@favoritesShow');
//widok "zespol"
Route::get('kontakty/zespol','Kontakty\KontaktyController@teamsShow');
//generowanie listy wszystkich firm
Route::get('kontakty/firmy/lista','Kontakty\Firmy\FirmyController@listShow');
//generowanie listy wszystkich osób
Route::get('kontakty/osoby/lista','Kontakty\Osoby\OsobyController@listShow');
//generowanie listy ulubionych osób
Route::get('kontakty/ulubione/osoby','Kontakty\Ulubione\UlubioneController@personsShow');
//generowanie listy ulubionych firm
Route::get('kontakty/ulubione/firmy','Kontakty\Ulubione\UlubioneController@companiesShow');
//generowanie widoku konkretnej firmy - przeglad danych na jej temat
Route::get('kontakty/firmy/przeglad/{id?}', ['uses'=>'Kontakty\Firmy\FirmyController@companyShow']);
//generowanie widoku konkretnej osoby - przeglad danych na jej temat
Route::get('kontakty/osoby/przeglad/{id?}', ['uses'=>'Kontakty\Osoby\OsobyController@personShow']);
//generowanie widoku konkretnej ulubionej osoby - przeglad danych na jej temat
Route::get('kontakty/ulubione/osoby/przeglad/{id?}', ['uses'=>'Kontakty\Osoby\OsobyController@personShow']);
//generowanie widoku konkretnej ulubionej firmy - przeglad danych na jej temat
Route::get('kontakty/ulubione/firmy/przeglad/{id?}', ['uses'=>'Kontakty\Firmy\FirmyController@companyShow']);
//widok ostatnio dodanych 5 firm
Route::get('kontakty/firmy/ostatnie','Kontakty\Firmy\FirmyController@lastListShow');
//widok ostatnio dodanych 5 osób
Route::get('kontakty/osoby/ostatnie','Kontakty\Osoby\OsobyController@lastListShow');
//widok dodawania nowej firmy
Route::get('kontakty/firmy/dodaj','Kontakty\Firmy\FirmyController@create');
//widok dodawania nowej osoby
Route::get('kontakty/osoby/dodaj','Kontakty\Osoby\OsobyController@create');
//dodawanie nowej firmy
Route::post('firma_dodano', 'Kontakty\Firmy\FirmyController@createNew');
//dodawanie nowej osoby
Route::post('osoba_dodano', 'Kontakty\Osoby\OsobyController@createNew');
//usuwanie firmy z ulubionych
Route::get('kontakty/ulubione/firmy/usun/{id?}', ['uses'=>'Kontakty\Ulubione\UlubioneController@companyDestroy']);
//usuwanie osoby z ulubionych
Route::get('kontakty/ulubione/osoby/usun/{id?}', ['uses'=>'Kontakty\Ulubione\UlubioneController@personDestroy']);
//dodawania firmy do ulubionych
Route::get('kontakty/firmy/ulubione/{id?}', ['uses'=>'Kontakty\Firmy\FirmyController@favoriteAdd']);
//dodawania osoby do ulubionych
Route::get('kontakty/osoby/ulubione/{id?}', ['uses'=>'Kontakty\Osoby\OsobyController@favoriteAdd']);

/*
 * MODUŁ ZADANIA BEGIN
 */
//widok główny modułu zadań
Route::get('zadania/','Zadania\ZadaniaController@index');
//widok todolist
Route::get('zadania/todolist','Zadania\ZadaniaController@todolistShow');
//widok listy zadan z todolist
Route::get('zadania/todolist/przeglad','Zadania\ToDoListController@todolistShow');
//widok zadan zespolu
Route::get('zadania/zespol','Zadania\ZadaniaController@teamShow');
//widok przegladu istniejacych spotkań
Route::get('zadania/spotkania/','Zadania\SpotkaniaController@meetingsShow');
//widok przegladu istniejacych spotkań
Route::get('zadania/spotkaniazakonczone/','Zadania\SpotkaniaController@closedMeetingsShow');
//widok dodawania nowego spotkania
Route::get('zadania/spotkania/dodaj/{id?}',['uses'=>'Zadania\SpotkaniaController@create']);
//widok zakonczenia spotkania
Route::get('zadania/spotkania/zakoncz/{id?}',['uses'=>'Zadania\SpotkaniaController@destroy']);
//widok zakonczenia zadania
Route::get('zadania/todolist/zakoncz/{id?}',['uses'=>'Zadania\ToDoListController@destroy']);
//dodawanie nowego spotkania
Route::post('spotkanie_dodano', 'Zadania\SpotkaniaController@createNew');
//dodawanie nowego zadania
Route::post('zadanie_dodano', 'Zadania\ToDoListController@createNew');
//widok dodawania nowego zadania
Route::get('zadania/todolist/dodaj', 'Zadania\ToDoListController@tasksCreateShow');

/*
 * MODUŁ ZADANIA END
 */
/*
 * MODUŁ ADMINISTRACJI BEGIN
 */
//widok administracji
Route::get('administracja','Admin\AdminController@index');
//widok administracji uzytkownikami
Route::get('administracja/uzytkownicy','Admin\AdminController@usersShow');
//widok administracji zespolami
Route::get('administracja/zespoly','Admin\AdminController@teamsShow');
//widok administracji zasobami
Route::get('administracja/zasoby','Admin\AdminController@resourcesShow');
//widok administracji newsletterem
Route::get('administracja/newsletter','Admin\AdminController@newsletterShow');
//generowanie widoku konkretnej osoby - przeglad i edycja danych
Route::get('administracja/uzytkownicy/przeglad/{id?}', ['uses'=>'Admin\AdminController@userEdit']);
//deaktywacja uzytkownika
Route::get('administracja/uzytkownicy/przeglad/dezaktywuj/{id?}', ['uses'=>'Admin\AdminController@deactivate']);
//aktywacja uzytkownika
Route::get('administracja/uzytkownicy/przeglad/aktywuj/{id?}', ['uses'=>'Admin\AdminController@activate']);
//usuniecie uzytkownika
Route::get('administracja/uzytkownicy/przeglad/usun/{id?}', ['uses'=>'Admin\AdminController@delete']);
//edycja zespolu
Route::post('zespol_edytowano', 'Admin\AdminController@updateTeamTo');
//edycja zasobow
Route::post('zasoby_edytowano', 'Admin\AdminController@updateResTo');
//wyslanie newslettera
Route::post('wyslano_newsa', 'Admin\AdminController@sendNews');
/*
 * MODUŁ ADMINISTRACJI END
 */



/* *
 * TEST MODUŁU KREOWANIA OFERTY W PDF
 * 
 * 
 *   */
Route::get('testpdf','TestPDFController@index');

//Route::get('/cennik/przeglad', function()
//{
//    $products = DB::table('products')->get();
//    return View::make('cennik.przeglad')->with('products',$products);
//});
Route::get('/cennik/przeglad', 'Cennik\CennikController@show');
Route::get('cennik/dodaj','Cennik\CennikController@create');
Route::get('cennik/dodaj_kategorie','Cennik\CennikController@createCategory');
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