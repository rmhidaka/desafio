<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Service\Cliente\ClienteServiceInterface',
            'App\Service\Cliente\ClienteService'
        );
        $this->app->bind(
            'App\Service\Pedido\PedidoServiceInterface',
            'App\Service\Pedido\PedidoService'
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
