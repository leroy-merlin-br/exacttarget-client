<?php
namespace LeroyMerlin\ExactTarget;

use Mockery as m;
use PHPUnit_Framework_TestCase as TestCase;

/**
* Test case for Token class
*/
class TokenTest extends TestCase
{
    public function testGetShouldExecuteRequestAndRetrieveATokenSuccessfully()
    {
        $clientId     = 'my-client-id';
        $clientSecret = 'my-super-secret-pass';
        $request      = m::mock(
            'LeroyMerlin\ExactTarget\Request[call]',
            [m::mock('GuzzleHttp\ClientInterface')]
        );

        $request->shouldReceive('call')
            ->with(
                'requestToken',
                'post',
                compact('clientId', 'clientSecret'),
                'auth'
            )->once()
            ->andReturn('my-super-token');

        $this->assertEquals(
            'my-super-token',
            (new Token($request))->get($clientId, $clientSecret)
        );
    }
}
