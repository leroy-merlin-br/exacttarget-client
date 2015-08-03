<?php
namespace LeroyMerlin\ExactTarget;

use Mockery as m;
use PHPUnit_Framework_TestCase as TestCase;

/**
* Test case for Request class
*/
class RequestBuilderTest extends TestCase
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
                sprintf(RequestBuilder::ENDPOINT, $subdomain, $action),
                []
            )->once()
            ->andReturn($expectedResponse);

        $this->assertEquals(
            $expectedResponse,
            (new RequestBuilder($client))->request($action)
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
                sprintf(RequestBuilder::ENDPOINT, $subdomain, $action),
                $parameters
            )->once()
            ->andReturn($expectedResponse);

        $this->assertEquals(
            $expectedResponse,
            (new RequestBuilder($client))->request(
                $action,
                $verb,
                $parameters,
                $subdomain
            )
        );
    }

    /**
     * @expectedException LeroyMerlin\ExactTarget\Exception\RequestException
     * @expectedExceptionMessage Unexpected error ocurred
     */
    public function testCallShouldThrowAnExceptionIfRequestFails()
    {
        $exception = m::mock('GuzzleHttp\Exception\ClientException');
        $response  = m::mock('Psr\Http\Message\ResponseInterface');

        $response->shouldReceive('getBody')
            ->once()
            ->andReturn('Unexpected error ocurred');

        $exception->shouldReceive('getResponse')
            ->once()
            ->andReturn($response);

        $client = m::mock('GuzzleHttp\ClientInterface');
        $client->shouldReceive('request')
            ->once()
            ->andThrow($exception);

        (new RequestBuilder($client))->request('some-action');
    }
}
