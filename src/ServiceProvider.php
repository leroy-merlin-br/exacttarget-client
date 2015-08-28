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
        $this->handleConfigs();
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->bind(Client::class, $this->getClosure());
    }

    /**
     * @return \Closure
     */
    public function getClosure()
    {
        return function () {
            $requestBuilder = new RequestBuilder(new GuzzleClient());

            return new Client(
                new Token(
                    config('exacttarget.clientId'),
                    config('exacttarget.clientSecret'),
                    $requestBuilder
                ),
                $requestBuilder
            );
        };
    }

    /**
     * Handle app configuration.
     */
    protected function handleConfigs()
    {
        $this->publishes(
            [
                __DIR__ . '/config/exacttarget.php' => config_path('exacttarget.php'),
            ]
        );
    }
}
