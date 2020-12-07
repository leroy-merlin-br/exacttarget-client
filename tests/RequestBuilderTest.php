<?php
namespace LeroyMerlin\ExactTarget;

use LeroyMerlin\ExactTarget\Exception\RequestException;
use Mockery as m;

/**
 * Test case for Request class
 */
class RequestBuilderTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function testCallShouldHitEndpointUsingDefaultParameters()
    {
        $verb             = 'get';
        $endpoint         = 'http://phpunit.com/api-action';
        $expectedResponse = 'action-response';
        $client           = m::mock('GuzzleHttp\ClientInterface');

        $client->shouldReceive('request')
            ->with($verb, $endpoint, [])
            ->once()
            ->andReturn($expectedResponse);

        $this->assertEquals(
            $expectedResponse,
            (new RequestBuilder($client))->request($endpoint)
        );
    }

    public function testCallShouldHitEndpointUsingCustomParameters()
    {
        $verb             = 'custom';
        $endpoint         = 'http://phpunit.com/custom-api-action';
        $parameters       = ['some', 'custom', 'parameters'];
        $expectedResponse = 'custom-action-response';
        $client           = m::mock('GuzzleHttp\ClientInterface');

        $client->shouldReceive('request')
            ->with($verb, $endpoint, $parameters)
            ->once()
            ->andReturn($expectedResponse);

        $this->assertEquals(
            $expectedResponse,
            (new RequestBuilder($client))->request(
                $endpoint,
                $verb,
                $parameters
            )
        );
    }

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

        $this->expectException(RequestException::class);
        $this->expectExceptionMessage('Unexpected error ocurred');

        (new RequestBuilder($client))->request('some-action');
    }
}
