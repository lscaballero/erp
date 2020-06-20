<?php

use Illuminate\Support\Facades\Route;
use App\Contract;

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

    // $contracts = Contract::all();
    // foreach ($contracts as $contract) {
    //     dump($contract->user->name);
    // }


    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
//usuarios
Route::get('/configuracion', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
//contratos
//crear contrato indefinido
Route::get('/contrato/indefinido', 'HomeController@indefined_create')->name('contract.indefined');
Route::post('/contrato/indefinido/guardar', 'HomeController@indefined_save')->name('indefined.save');
//crear contrato por servicios
Route::get('/contrato/porservicios', 'HomeController@services_create')->name('contract.services');
Route::post('/contrato/porservicios/guardar', 'HomeController@services_save')->name('services.save');
//listar usuarios
Route::get('/contrato/listado', 'ContractsController@list_contracts')->name('contract.list');
//actualizar contrato indefinido
Route::get('/contrato/indefinido/listado', 'ContractsController@indefined_list_users')->name('indefined.list');
Route::post('/contrato/indefinido/actualizar{id}', 'ContractsController@indefined_update')->name('indefined.update');
//eliminar contrato indefinido
Route::post('/contrato/indefinido/borrar/{id}', 'ContractsController@indefined_delete')->name('indefined.delete');
//actualizar contrato por servicios
Route::get('/contrato/servicios/listado', 'ContractsController@services_list_users')->name('services.list');
Route::post('/contrato/servicios/actualizar{id}', 'ContractsController@services_update')->name('services.update');
//eliminar contrato por servicios
Route::post('/contrato/servicios/borrar/{id}', 'ContractsController@services_delete')->name('services.delete');


