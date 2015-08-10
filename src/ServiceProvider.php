<?php
namespace LeroyMerlin\ExactTarget;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * @var string
     */
    protected $packageName = 'leroy-merlin-br/exacttarget-client';

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->package($this->packageName);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->bind('LeroyMerlin\ExactTarget\Client', function ($app) {
            $requestBuilder = new RequestBuilder(new GuzzleClient());

            return new Client(
                new Token(
                    $app['config']->get('clientId'),
                    $app['config']->get('clientSecret'),
                    $requestBuilder
                ),
                $requestBuilder
            );
        });

        $this->handleConfigs();
    }

    private function handleConfigs()
    {
        $this->app['config']->package($this->packageName, __DIR__.'/../config');
    }
}
