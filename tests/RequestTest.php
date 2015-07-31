<?php
namespace LeroyMerlin\ExactTarget;

use PHPUnit_Framework_TestCase as TestCase;

use Mockery as m;

/**
* Test case for Request class
*/
class RequestTest extends TestCase
{
    public function testPerformRequestShouldHitEndpointUsingDefaultParameters()
    {
        $verb             = 'get';
        $action           = 'api-action';
        $subdomain        = 'www';
        $expectedResponse = 'action-response';
        $client           = m::mock('GuzzleHttp\ClientInterface');

        $client->shouldReceive('request')
            ->with(
                'get',
                sprintf(Request::ENDPOINT, $subdomain, $action),
                []
            )->once()
            ->andReturn($expectedResponse);

        $this->assertEquals(
            $expectedResponse,
            (new Request($client))->call($action)
        );
    }
}
