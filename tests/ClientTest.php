<?php
namespace LeroyMerlin\ExactTarget;

use Mockery as m;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Test case for Client class
 */
class ClientTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    public function testPerformRequestShouldCallWebServiceUsingServiceEnum()
    {
        $requestBuilder     = m::mock(
            'LeroyMerlin\ExactTarget\RequestBuilder[request]',
            [m::mock('GuzzleHttp\ClientInterface')]
        );
        $tokenString        = 'my-token';
        $token              = m::mock(
            'LeroyMerlin\ExactTarget\Token[request]',
            ['client-id', 'client-secret', $requestBuilder]
        );
        $parameters         = [
            'data' => [
                'my' => 'parameters',
            ],
        ];
        $expectedParameters = [
            'json' => $parameters['data'],
            'headers' => ['Authorization' => 'Bearer ' . $tokenString],
        ];

        $token->shouldReceive('request')
            ->once()
            ->andReturnSelf()
            ->getMock()
            ->shouldReceive('getBody')
            ->once()
            ->andReturn(json_encode(['accessToken' => $tokenString]));

        $response = 'awesome response';
        $requestBuilder->shouldReceive('request')
            ->twice()
            ->with(
                'https://auth.exacttargetapis.com/v1/requestToken',
                'post',
                $expectedParameters
            )->andReturn($response);

        $client = (new  Client($token, $requestBuilder));

        $this->assertEquals(
            $response,
            $client->requestToken($parameters)
        );

        //Coverage purposes
        $this->assertEquals(
            $response,
            $client->requestToken($parameters)
        );
    }
}
