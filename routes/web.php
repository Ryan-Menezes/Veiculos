<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\{
	PanelController,
	PerfilController,
	MyRequestController,
	UserController,
	VehicleController,
	ManufacturerController,
	CategoryController,
	DiscountController,
	RequestController,
	RoleController,
	PermissionController
};
use App\Http\Controllers\Site\{
	SiteController,
	VehicleController as VCS,
	ContactController,
	CartController,
	RequestController as RCS
};

// AUTHENTICATE
Auth::routes();

// SITE
Route::group(['prefix' => '/'], function(){
	Route::get('/', [SiteController::class, 'index'])->name('site');

	// CONTACT
	Route::group(['prefix' => 'contato'], function(){
		Route::get('/', [ContactController::class, 'index'])->name('site.contact');
		Route::put('/enviar', [ContactController::class, 'send'])->name('site.contact.send');
	});

	// VEHICLES
	Route::group(['prefix' => 'veiculos'], function(){
		Route::get('/', [VCS::class, 'index'])->name('site.vehicles');
		Route::any('/buscar', [VCS::class, 'search'])->name('site.vehicles.search');
		Route::get('/{slug}', [VCS::class, 'show'])->name('site.vehicles.show');
		Route::get('/{slug}/comprar', [VCS::class, 'buy'])->name('site.vehicles.buy');		
	});

	// CART
	Route::group(['prefix' => 'carrinho'], function(){
		Route::get('/', [CartController::class, 'index'])->name('site.cart');
		Route::get('/adicionar/{vehicle}', [CartController::class, 'add'])->name('site.cart.add');
		Route::get('/remover/{vehicle}', [CartController::class, 'remove'])->name('site.cart.remove');
		Route::get('/limpar', [CartController::class, 'clear'])->name('site.cart.clear');
		Route::put('/edit/{vehicle}', [CartController::class, 'edit'])->name('site.cart.edit');
	});

	// REQUEST
	Route::group(['prefix' => 'pedidos', 'middleware' => 'auth'], function(){
		Route::get('/{requestmodel}', [RCS::class, 'show'])->name('site.requests.show');
		Route::put('/novo', [RCS::class, 'store'])->name('site.requests.store');
	});
});

// PANEL
Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function(){
	Route::get('/', [PanelController::class, 'index'])->name('panel');

	// PERFIL
	Route::group(['prefix' => 'perfil'], function(){
		Route::get('/', [PerfilController::class, 'index'])->name('panel.perfil');
		Route::put('/dados/eitar', [PerfilController::class, 'updateUser'])->name('panel.perfil.user.update');
		Route::put('/password/editar', [PerfilController::class, 'updateUserPassword'])->name('panel.perfil.user.update.password');
	});

	// MY REQUESTS
	Route::group(['prefix' => 'meus-pedidos'], function(){
		Route::get('/', [MyRequestController::class, 'index'])->name('panel.myrequests');
		Route::any('/carrega/{offset?}/{limit?}/{search?}', [MyRequestController::class, 'load'])->name('panel.myrequests.load');
		Route::put('/{requestmodel}/cancelar', [MyRequestController::class, 'cancel'])->name('panel.myrequests.cancel');
	});

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

	// REQUESTS
	Route::group(['prefix' => 'pedidos'], function(){
		Route::get('/', [RequestController::class, 'index'])->name('panel.requests');
		Route::get('/{requestmodel}', [RequestController::class, 'show'])->name('panel.requests.show');
		Route::any('/carrega/{offset?}/{limit?}/{search?}', [RequestController::class, 'load'])->name('panel.requests.load');
		Route::get('/{requestmodel}/editar', [RequestController::class, 'edit'])->name('panel.requests.edit');
		Route::put('/{requestmodel}', [RequestController::class, 'update'])->name('panel.requests.update');
		Route::delete('/{requestmodel}', [RequestController::class, 'destroy'])->name('panel.requests.destroy');
	});

	// ROLES
	Route::group(['prefix' => 'funcoes'], function(){
		Route::get('/', [RoleController::class, 'index'])->name('panel.roles');
		Route::any('/carrega/{offset?}/{limit?}/{search?}', [RoleController::class, 'load'])->name('panel.roles.load');
		Route::get('/novo', [RoleController::class, 'create'])->name('panel.roles.create');
		Route::post('/', [RoleController::class, 'store'])->name('panel.roles.store');
		Route::get('/{role}/editar', [RoleController::class, 'edit'])->name('panel.roles.edit');
		Route::put('/{role}', [RoleController::class, 'update'])->name('panel.roles.update');
		Route::delete('/{role}', [RoleController::class, 'destroy'])->name('panel.roles.destroy');
	});

	// PERMISSIONS
	Route::group(['prefix' => 'permissoes'], function(){
		Route::get('/', [PermissionController::class, 'index'])->name('panel.permissions');
		Route::any('/carrega/{offset?}/{limit?}/{search?}', [PermissionController::class, 'load'])->name('panel.permissions.load');
		Route::get('/{permission}/editar', [PermissionController::class, 'edit'])->name('panel.permissions.edit');
		Route::put('/{permission}', [PermissionController::class, 'update'])->name('panel.permissions.update');
	});
});