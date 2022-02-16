<?php

use App\Models\User;
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

Route::get('/home', function () {
    return redirect(route('index'));
});
Route::namespace('App\Http\Controllers')->middleware('auth')->group(function (){

    Route::resource('index', 'ComputadorController');
    Route::get('comp/index', 'ComputadorController@index')->name('index');
    Route::get('comp/create',    'ComputadorController@create')->name('computador.create');
    Route::post('comp/create/save',   'ComputadorController@store')->name('computador.store');
    Route::get('comp/edit/{id}', 'ComputadorController@edit')->name('computador.edit');
    Route::put('comp/update/{id}', 'ComputadorController@update')->name('computador.update');
    Route::get('comp/show/{id}', 'ComputadorController@show')->name('computador.show');  

    Route::get('comp/{id}/print','ComputadorController@imprimir')->name('computador.imprimir');

    Route::post('comp/comentario/delete','ComentarioController@destroy')->name('comentario.destroy');
    Route::get('comp/{id}/comentario/new','ComentarioController@create')->name('comentario.create');
    Route::post('comp/comentario/{id}/store','ComentarioController@store')->name('comentario.store');
    Route::get('comp/comentario/edit/{id}','ComentarioController@edit')->name('comentario.edit');
    Route::put('comp/comentario/update/{id}','ComentarioController@update')->name('comentario.update');

    Route::get('user/profile','ProfileController@show')->name('user.profile');
    Route::post('user/profile','ProfileController@changeUserName')->name('user.name.change');
    Route::get('user/password/change','ProfileController@showChangePassword')->name('user.show.password.change');
    Route::post('user/password/change','ProfileController@changeUserPassword')->name('user.password.change');

    Route::get('user/admin/show/all', 'AdminController@showAllUsers')->name('admin.show.all');
    Route::get('user/admin/create','AdminController@crearUsuario')->name('user.create');
    Route::post('user/admin/strore','AdminController@storeUsuario')->name('user.store');
    Route::get('user/admin/roles','AdminController@editRoles')->name('admin.roles.edit');
    Route::post('user/admin/roles/save','AdminController@updateRoles')->name('admin.roles.update');
    Route::post('user/admin/store','AdminController@storeUsuario')->name('user.store');
    Route::get('user/admin/control/delete','AdminController@showUserDelete')->name('user.admin.delete');
    Route::post('user/admin/control/delete','AdminController@userDelete')->name('user.admin.delete');
    
});
