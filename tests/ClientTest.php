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
        $token = m::mock(
            'LeroyMerlin\ExactTarget\Token[request]',
            ['client-id', 'client-secret', $requestBuilder]
        );
        $parameters = ['my', 'parameters'];

        $token->shouldReceive('request')
            ->once()
            ->andReturn('my-token');

        $response = 'awesome response';
        $requestBuilder->shouldReceive('request')
            ->once()
            ->with('contacts', 'post', $parameters, 'www')
            ->andReturn($response);

        $this->assertEquals(
            $response,
            (new Client($token, $requestBuilder))->createContact($parameters)
        );
    }
}
