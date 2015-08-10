<?php
namespace LeroyMerlin\ExactTarget;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->handleConfigs();
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Bind any implementations.
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [];
    }

    private function handleConfigs()
    {
        $configPath = __DIR__.'/../config/exacttarget-client.php';

        $this->publishes([
            $configPath => config_path('exacttarget-client.php')
        ]);
        $this->mergeConfigFrom($configPath, 'exacttarget-client');
    }
}
