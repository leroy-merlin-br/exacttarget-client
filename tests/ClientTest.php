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
        $requestBuilder = m::mock(
            'LeroyMerlin\ExactTarget\RequestBuilder[request]',
            [m::mock('GuzzleHttp\ClientInterface')]
        );
        $tokenString = 'my-token';
        $token = m::mock(
            'LeroyMerlin\ExactTarget\Token[request]',
            ['client-id', 'client-secret', $requestBuilder]
        );
        $parameters         = ['my' => 'parameters'];
        $expectedParameters = [
            'json' => $parameters,
            'headers' => ['Authorization' => 'Bearer '.$tokenString],
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
            ->once()
            ->with(
                'https://auth.exacttargetapis.com/v1/requestToken',
                'post',
                $expectedParameters
            )->andReturn($response);

        $this->assertEquals(
            $response,
            (new Client($token, $requestBuilder))->requestToken(
                $parameters
            )
        );
    }
}
