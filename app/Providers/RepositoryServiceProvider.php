<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            'App\Repository\Cliente\ClienteRepositoryInterface',
            'App\Repository\Cliente\ClienteRepository'
        );
        $this->app->bind(
            'App\Repository\Pedido\PedidoRepositoryInterface',
            'App\Repository\Pedido\PedidoRepository'
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
