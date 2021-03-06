<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\OptionTerm\OptionTermInterface;
use App\Repositories\OptionTerm\OptionTermRepository;

class OptionTermServiceProvider extends ServiceProvider
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
            OptionTermInterface::class,
            OptionTermRepository::class
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
            OptionTermInterface::class,
        ];
    }
}
