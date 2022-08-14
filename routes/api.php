<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ClientController;
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
//
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group( ['middleware' => ['auth:sanctum'] ],function(){
  Route::get('/companies', [CompanyController::class, 'getApiCompanies'])->name('APIcompanies')->middleware('JSONmiddleware');
  Route::get('/clients/{id}', [ClientController::class, 'getApiClients'])->name('APIclients')->middleware('JSONmiddleware');
  Route::get('/client_companies/{id}', [ClientController::class, 'getApiClientsCompanies'])->name('APIclient_companies')->middleware('JSONmiddleware');
});
