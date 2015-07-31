<?php
namespace LeroyMerlin\ExactTarget;

use Mockery as m;
use PHPUnit_Framework_TestCase as TestCase;

/**
* Test case for Request class
*/
class RequestTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

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

    /**
     * @expectedException LeroyMerlin\ExactTarget\Exception\RequestException
     * @expectedExceptionMessage 500: Server Error
     */
    public function testCallShouldThrowAnExceptionIfRequestFails()
    {
        $client = m::mock('GuzzleHttp\ClientInterface');
        $client->shouldReceive('request')
            ->once()
            ->andThrow(
                'GuzzleHttp\Exception\ClientException',
                '500: Server Error',
                m::mock('Psr\Http\Message\RequestInterface')
            );

        (new Request($client))->call('some-action');
    }
}
