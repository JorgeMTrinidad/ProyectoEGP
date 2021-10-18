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
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::group(['middleware' => ['guest']], function () {

    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');

});


Route::group(['middleware' => ['auth']], function () {


    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');




    Route::group(['middleware' => ['Auditor']], function () {

        Route::resource('categoria', 'CategoriaController');
        Route::resource('producto', 'ProductoController');
        Route::resource('proveedor', 'ProveedorController');


    });

    Route::group(['middleware' => ['Auxiliar']], function () {

         Route::resource('categoria', 'CategoriaController');
         Route::resource('producto', 'ProductoController');
         Route::resource('maestroObras', 'MaestroObrasController');
         Route::resource('user', 'UserController');


    });

    Route::group(['middleware' => ['Supervisor']], function () {

      Route::resource('categoria', 'CategoriaController');
      Route::resource('producto', 'ProductoController');
      Route::resource('proveedor', 'ProveedorController');
      Route::resource('maestroObras', 'MaestroObrasController');
      Route::resource('rol', 'RolController');
      Route::resource('user', 'UserController');



    });




});
