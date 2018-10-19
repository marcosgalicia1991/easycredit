<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Request\RequestInterface;
use App\Repositories\Request\RequestRepository;
use App\Handlers\Request\RequestDataHandlerInterface;
use App\Handlers\Request\RequestDataHandler;

class RequestServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RequestInterface::class,
            RequestRepository::class
        );

        $this->app->bind(
            RequestDataHandlerInterface::class,
            RequestDataHandler::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            RequestInterface::class,
            RequestDataHandlerInterface::class,
        ];
    }
}
