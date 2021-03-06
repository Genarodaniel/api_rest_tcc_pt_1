<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

//Route::middleware('auth:api')->get('/users', 'UserController@index');

//Route::get('/users', 'UserController@list');
/*Route::get('/', function () {
return 'Minha primeira rota com laravel';
});

Route::get('/ok', function () {
return ['status' => true];
});*/

Route::namespace ('API')->name('api')->group(function () {
	Route::get('/users', 'UserController@index')->name('users');
})

?>