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

Route::group(['middleware' => ['guest']], function () {

    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');

});


Route::group(['middleware' => ['auth']], function () {

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/home', 'HomeController@index');


    Route::group(['middleware' => ['Auxiliar']], function () {

        Route::resource('categoria', 'CategoriaController');
         Route::resource('producto', 'ProductoController');
         Route::get('/listarProductoPdf', 'ProductoController@listarPdf')->name('productos_pdf');
         Route::resource('maestroObras', 'MaestroObrasController');
         Route::resource('egreso', 'EgresoController');
         Route::get('/pdfEgreso/{id}', 'EgresoController@pdf')->name('egreso_pdf');

    });

    Route::group(['middleware' => ['Auditor']], function () {

         Route::resource('categoria', 'CategoriaController');
         Route::resource('producto', 'ProductoController');
         Route::get('/listarProductoPdf', 'ProductoController@listarPdf')->name('productos_pdf');
         Route::resource('maestroObras', 'MaestroObrasController');
    });


    Route::group(['middleware' => ['Supervisor']], function () {

      Route::resource('categoria', 'CategoriaController');
      Route::resource('producto', 'ProductoController');
      Route::get('/listarProductoPdf', 'ProductoController@listarPdf')->name('productos_pdf');
      Route::resource('proveedor', 'ProveedorController');
      Route::resource('ingreso', 'IngresoController');
      Route::get('/pdfIngreso/{id}', 'IngresoController@pdf')->name('ingreso_pdf');
      Route::resource('egreso', 'EgresoController');
      Route::get('/pdfEgreso/{id}', 'EgresoController@pdf')->name('egreso_pdf');
      Route::resource('credito', 'CreditoController');
      Route::get('/pdfCredito/{id}', 'CreditoController@pdf')->name('credito_pdf');
      Route::resource('maestroObras', 'MaestroObrasController');
      Route::resource('rol', 'RolController');
      Route::resource('user', 'UserController');

    });


});

