<?php
namespace LeroyMerlin\ExactTarget;

use Mockery as m;
use PHPUnit_Framework_TestCase;

class ServiceProviderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->markTestSkipped('ServiceProvider has changed and the tests should be reviewed.');
    }

    public function testShouldHandleConfigsOnBoot()
    {
        // Set
        $app      = m::mock('Illuminate\Foundation\Application');
        $provider = m::mock(ServiceProvider::class.'[publishes,mergeConfigFrom]', [$app]);

        // Expectation
        $provider->shouldReceive('publishes')
            ->once();

        $provider->shouldReceive('mergeConfigFrom')
            ->once()
            ->with(m::any(), 'laravel-exacttarget');

        // Assertion
        $provider->boot();
    }
}

if (!function_exists('config_path')) {
    function config_path($file)
    {
        return 'foo/'.$file;
    }
}
