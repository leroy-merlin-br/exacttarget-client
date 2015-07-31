<?php
namespace LeroyMerlin\ExactTarget;

use PHPUnit_Framework_TestCase as TestCase;

use Mockery as m;

/**
* Test case for Request class
*/
class RequestTest extends TestCase
{
    public function testCallShouldHitEndpointUsingDefaultParameters()
    {
        $verb             = 'get';
        $action           = 'api-action';
        $subdomain        = 'www';
        $expectedResponse = 'action-response';
        $client           = m::mock('GuzzleHttp\ClientInterface');

        $client->shouldReceive('request')
            ->with(
                $verb,
                sprintf(Request::ENDPOINT, $subdomain, $action),
                []
            )->once()
            ->andReturn($expectedResponse);

        $this->assertEquals(
            $expectedResponse,
            (new Request($client))->call($action)
        );
    }

    public function testCallShouldHitEndpointUsingCustomParameters()
    {
        $verb             = 'custom';
        $action           = 'custom-api-action';
        $subdomain        = 'custom';
        $parameters       = ['some', 'custom', 'parameters'];
        $expectedResponse = 'custom-action-response';
        $client           = m::mock('GuzzleHttp\ClientInterface');

        $client->shouldReceive('request')
            ->with(
                $verb,
                sprintf(Request::ENDPOINT, $subdomain, $action),
                $parameters
            )->once()
            ->andReturn($expectedResponse);

        $this->assertEquals($expectedResponse, (new Request($client))->call(
            $action,
            $verb,
            $parameters,
            $subdomain
        ));
    }
}
