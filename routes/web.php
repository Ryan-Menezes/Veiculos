<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\{
	PanelController,
	UserController,
	VehicleController
};
use App\Http\Controllers\Site\{
	SiteController
};

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

// SITE
Route::group(['prefix' => '/'], function(){
	Route::get('/', [SiteController::class, 'index'])->name('site');
	Route::get('/contato', [SiteController::class, 'contact'])->name('site.contact');
});

// AUTHENTICATE
Auth::routes();

// PANEL
Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function(){
	Route::get('/', [PanelController::class, 'index'])->name('panel');

	// USERS
	Route::group(['prefix' => 'usuarios'], function(){
		Route::get('/', [UserController::class, 'index'])->name('panel.users');
		Route::any('/carrega/{offset?}/{limit?}/{search?}', [UserController::class, 'load'])->name('panel.users.load');
		Route::get('/{user}/editar', [UserController::class, 'edit'])->name('panel.users.edit');
		Route::put('/{user}', [UserController::class, 'update'])->name('panel.users.update');
		Route::delete('/{user}', [UserController::class, 'destroy'])->name('panel.users.destroy');
	});

	// VEHICLES
	Route::group(['prefix' => 'veiculos'], function(){
		Route::get('/', [VehicleController::class, 'index'])->name('panel.vehicles');
		Route::any('/carrega/{offset?}/{limit?}/{search?}', [VehicleController::class, 'load'])->name('panel.vehicles.load');
		Route::get('/create', [VehicleController::class, 'create'])->name('panel.vehicles.create');
		Route::post('/', [VehicleController::class, 'store'])->name('panel.vehicles.store');
		Route::get('/{vehicle}/editar', [VehicleController::class, 'edit'])->name('panel.vehicles.edit');
		Route::put('/{vehicle}', [VehicleController::class, 'update'])->name('panel.vehicles.update');
		Route::delete('/{vehicle}', [VehicleController::class, 'destroy'])->name('panel.vehicles.destroy');
	});
});