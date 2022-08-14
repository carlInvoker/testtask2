<?php

use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Models\Client;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ClientController;

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
    return view('welcome');
});


Route::group( ['middleware' => ['auth'] ],function(){
  Route::get('/dashboard', function () {  return view('admin.dashboard'); })->name('dashboard');
  Route::get('/apis', function () {  return view('admin.apis'); })->name('apis');

  Route::get('/newCompany', function () {  return view('admin.company'); })->name('newCompany');
  Route::get('/companies', [CompanyController::class, 'getCompanies'])->name('companies');
  Route::get('/company/{company}', [CompanyController::class, 'getCompany'])->name('company');
  Route::post('/companies', [CompanyController::class, 'addCompany'])->name('addCompany');
  Route::put('/companies/{company}', [CompanyController::class, 'updateCompany'])->name('updateCompany');
  Route::delete('/companies/{company}', [CompanyController::class, 'deleteCompany'])->name('deleteCompany');
                                                                              
  Route::get('/clients', [ClientController::class, 'getClients'])->name('clients');
  Route::get('/client/{client}', [ClientController::class, 'getClient'])->name('client');
  Route::get('/newClient', [ClientController::class, 'clientPage'])->name('newClient');
  Route::post('/clients', [ClientController::class, 'addClient'])->name('addClient');
  Route::put('/clients/{client}', [ClientController::class, 'updateClient'])->name('updateClient');
  Route::delete('/clients/{client}', [ClientController::class, 'deleteClient'])->name('deleteClient');

});
require __DIR__.'/auth.php';
