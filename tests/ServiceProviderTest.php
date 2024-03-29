<?php
namespace LeroyMerlin\ExactTarget;

use Closure;
use Illuminate\Foundation\Application;
use Mockery as m;

class ServiceProviderTest extends TestCase
{
    public function testShouldHandleConfigsOnBoot()
    {
        // Set
        $app      = m::mock(Application::class);
        $provider = m::mock(ServiceProvider::class . '[publishes]', [$app]);
        $provider->shouldAllowMockingProtectedMethods();

        // Expectation
        $provider->shouldReceive('publishes')
            ->once();

        // Assertion
        $provider->boot();
    }

    public function testShouldRegister()
    {
        // Set
        $app      = m::mock(Application::class);
        $provider = new ServiceProvider($app);

        // Expectation
        $app->shouldReceive('bind')
            ->once()
            ->with(Client::class, m::any());

        // Assertion
        $provider->register();
    }

    public function testShouldGetClosure()
    {
        // Set
        $provider = new ServiceProvider(m::mock(Application::class));
        $closure = $provider->getClosure();

        // Assertion
        $this->assertInstanceOf(Closure::class, $closure);
        $this->assertInstanceOf(Client::class, $closure());
    }
}

if (! function_exists('config_path')) {
    function config_path($file)
    {
        return 'foo/' . $file;
    }
}
if (! function_exists('config')) {
    function config($key)
    {
        return 'value:' . $key;
    }
}
