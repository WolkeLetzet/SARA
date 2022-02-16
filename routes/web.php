<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect(route('index'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers')->middleware('auth')->group(function (){
    Route::resource('index', 'ComputadorController');
    Route::get('comp/index', 'ComputadorController@index')->name('index');
    Route::get('comp/create',    'ComputadorController@create')->name('computador.create');
    Route::post('comp/create',   'ComputadorController@store')->name('computador.store');
    Route::get('comp/edit/{id}', 'ComputadorController@edit')->name('computador.edit');
    Route::post('comp/edit/{id}', 'ComputadorController@update')->name('computador.update');
    Route::get('comp/show/{id}', 'ComputadorController@show')->name('computador.show');  
    
    Route::get('comp/imprimir/{id}', 'ComputadorController@imprimir')->name('imprimir');
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
