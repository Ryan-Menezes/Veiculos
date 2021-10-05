<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\PanelController;

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
    return view('site.index');
});

Auth::routes();

Route::group(['prefix' => 'painel', 'middleware' => 'auth', 'name' => 'panel.'], function(){
	Route::get('/', [PanelController::class, 'index'])->name('index');	
});