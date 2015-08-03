<?php
namespace LeroyMerlin\ExactTarget;

/**
* This class is responsible to call API in order to get a token to authenticate
* next API requests
*/
class Token
{
    /**
     * @var RequestBuilder
     */
    protected $requestBuilder;

    /**
     * Constructor
     */
    public function __construct(RequestBuilder $requestBuilder)
    {
        $this->requestBuilder = $requestBuilder;
    }

    /**
     * Retrieves a new token to API authentication
     *
     * @param  string $clientId
     * @param  string $clientSecret
     *
     * @return string
     */
    public function get($clientId, $clientSecret)
    {
        return $this->requestBuilder->request(
            'requestToken',
            'post',
            compact('clientId', 'clientSecret'),
            'auth'
        );
    }
}
