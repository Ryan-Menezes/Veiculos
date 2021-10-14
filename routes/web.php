<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\{
	PanelController,
	UserController,
	VehicleController,
	ManufacturerController,
	CategoryController,
	DiscountController
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
		Route::get('/novo', [VehicleController::class, 'create'])->name('panel.vehicles.create');
		Route::post('/', [VehicleController::class, 'store'])->name('panel.vehicles.store');
		Route::get('/{vehicle}/editar', [VehicleController::class, 'edit'])->name('panel.vehicles.edit');
		Route::put('/{vehicle}', [VehicleController::class, 'update'])->name('panel.vehicles.update');
		Route::delete('/{vehicle}', [VehicleController::class, 'destroy'])->name('panel.vehicles.destroy');
	});

	// MANUFACTURERS
	Route::group(['prefix' => 'fabricantes'], function(){
		Route::get('/', [ManufacturerController::class, 'index'])->name('panel.manufacturers');
		Route::any('/carrega/{offset?}/{limit?}/{search?}', [ManufacturerController::class, 'load'])->name('panel.manufacturers.load');
		Route::get('/novo', [ManufacturerController::class, 'create'])->name('panel.manufacturers.create');
		Route::post('/', [ManufacturerController::class, 'store'])->name('panel.manufacturers.store');
		Route::get('/{manufacturer}/editar', [ManufacturerController::class, 'edit'])->name('panel.manufacturers.edit');
		Route::put('/{manufacturer}', [ManufacturerController::class, 'update'])->name('panel.manufacturers.update');
		Route::delete('/{manufacturer}', [ManufacturerController::class, 'destroy'])->name('panel.manufacturers.destroy');
	});

	// CATEGORIES
	Route::group(['prefix' => 'categorias'], function(){
		Route::get('/', [CategoryController::class, 'index'])->name('panel.categories');
		Route::any('/carrega/{offset?}/{limit?}/{search?}', [CategoryController::class, 'load'])->name('panel.categories.load');
		Route::get('/novo', [CategoryController::class, 'create'])->name('panel.categories.create');
		Route::post('/', [CategoryController::class, 'store'])->name('panel.categories.store');
		Route::get('/{category}/editar', [CategoryController::class, 'edit'])->name('panel.categories.edit');
		Route::put('/{category}', [CategoryController::class, 'update'])->name('panel.categories.update');
		Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('panel.categories.destroy');
	});

	// DISCOUNTS
	Route::group(['prefix' => 'descontos'], function(){
		Route::get('/', [DiscountController::class, 'index'])->name('panel.discounts');
		Route::any('/carrega/{offset?}/{limit?}/{search?}', [DiscountController::class, 'load'])->name('panel.discounts.load');
		Route::get('/novo', [DiscountController::class, 'create'])->name('panel.discounts.create');
		Route::post('/', [DiscountController::class, 'store'])->name('panel.discounts.store');
		Route::get('/{discount}/editar', [DiscountController::class, 'edit'])->name('panel.discounts.edit');
		Route::put('/{discount}', [DiscountController::class, 'update'])->name('panel.discounts.update');
		Route::delete('/{discount}', [DiscountController::class, 'destroy'])->name('panel.discounts.destroy');
	});
});