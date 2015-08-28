<?php
namespace LeroyMerlin\ExactTarget;

/**
 * This class is responsible to call API in order to get a token to authenticate
 * next API requests
 */
class Token
{
    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var RequestBuilder
     */
    protected $requestBuilder;

    /**
     * Constructor
     *
     * @param string         $clientId     ExactTarget client ID
     * @param string         $clientSecret ExactTarget client secret
     * @param RequestBuilder $requestBuilder
     */
    public function __construct(
        $clientId,
        $clientSecret,
        RequestBuilder $requestBuilder
    ) {
        $this->clientId       = $clientId;
        $this->clientSecret   = $clientSecret;
        $this->requestBuilder = $requestBuilder;
    }

    /**
     * Retrieves a new token to API authentication
     *
     * @return string
     */
    public function request()
    {
        $requestInfo = ServiceEnum::toEndpoint('requestToken');
        $parameters  = [
            'clientId'     => $this->clientId,
            'clientSecret' => $this->clientSecret,
        ];

        return $this->requestBuilder->request(
            (new UrlBuilder())->build(
                $requestInfo['subdomain'],
                $requestInfo['action'],
                $requestInfo['service']
            ),
            $requestInfo['method'],
            ['json' => $parameters]
        );
    }
}
