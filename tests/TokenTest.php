<?php
namespace LeroyMerlin\ExactTarget;

use Mockery as m;

/**
 * Test case for Token class
 */
class TokenTest extends TestCase
{
    public function testGetShouldExecuteRequestAndRetrieveATokenSuccessfully()
    {
        $clientId       = 'my-client-id';
        $clientSecret   = 'my-super-secret-pass';
        $requestBuilder = m::mock(
            'LeroyMerlin\ExactTarget\RequestBuilder[request]',
            [m::mock('GuzzleHttp\ClientInterface')]
        );

        $requestBuilder->shouldReceive('request')
            ->with(
                'https://auth.exacttargetapis.com/v1/requestToken',
                'post',
                ['json' => compact('clientId', 'clientSecret')]
            )->once()
            ->andReturn('my-super-token');

        $this->assertEquals(
            'my-super-token',
            (new Token($clientId, $clientSecret, $requestBuilder))->request()
        );
    }
}
