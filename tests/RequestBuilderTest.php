<?php
namespace LeroyMerlin\ExactTarget;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use LeroyMerlin\ExactTarget\Exception\RequestException;
use Mockery as m;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

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
        $expectedResponse = new Response(200, [], 'action-response');
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
        $expectedResponse = new Response(200, [], 'custom-action-response');
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
        $exception = m::mock(ClientException::class);
        $response  = m::mock(ResponseInterface::class);
        $stream = m::mock(StreamInterface::class);

        $response->shouldReceive('getBody')
            ->once()
            ->andReturn($stream);

        $stream->shouldReceive('__toString')
            ->once()
            ->andReturn('Unexpected error occurred');

        $exception->shouldReceive('getResponse')
            ->once()
            ->andReturn($response);

        $client = m::mock(ClientInterface::class);
        $client->shouldReceive('request')
            ->once()
            ->andThrow($exception);

        $this->expectException(RequestException::class);
        $this->expectExceptionMessage('Unexpected error occurred');

        (new RequestBuilder($client))->request('some-action');
    }
}
