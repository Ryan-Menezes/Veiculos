<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Route::resourceVerbs([
            'create'    => 'novo',
            'store'     => 'salvar',
            'edit'      => 'editar',
            'update'    => 'atualizar',
            'destroy'   => 'delete',
            'show'      => 'visualizar'
        ]);
    }
}
