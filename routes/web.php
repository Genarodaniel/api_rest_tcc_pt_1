
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

/*Route::get('/', function () {
return view('welcome');
});*/

Route::get('/', function () {
	return 'Minha primeira rota com laravel';
});

//Route::get('/users', 'UserController@list');
/*
Route::group(['middleware' => 'auth'], function () {
Route::get('/route/selector', 'PagesController@selectRoute');

// Admin Only //

Route::group(['middleware' => 'isAdmin'], function () {
Route::get('/admin', 'AdminController@index');
Route::group(['namespace' => 'App\Http\Controllers'], function () {
Route::get('/users', 'UserController@list');

});
});
});*/
