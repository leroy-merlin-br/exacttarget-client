<?php
namespace LeroyMerlin\ExactTarget;

class Client
{
    /**
     * OAuth token passed to API requests. You can set it manually or request
     * it using the getToken method.
     * @var string
     */
    public $accessToken;

    /**
     * Injects Laravel application into the instance
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Token $token, RequestBuilder $requestBuilder)
    {
        $this->token          = $token;
        $this->requestBuilder = $requestBuilder;
    }

    public function __call($action, $arguments)
    {
        $token      = $this->getToken();
        $actionInfo = ServiceEnum::toEndpoint($action);

        return $this->requestBuilder->request(
            $actionInfo['action'],
            $actionInfo['method'] ?: 'get',
            $arguments[0],
            'www'
        );
    }

    /**
     * Obtain and stores the OAuth token from ExactTarget. Even tought this
     * method retuns the Access token, it will be stored within the instance
     * for future requests.
     * If no $clientID or $clientSecret is provided, they will be loaded from
     * the config file.
     *
     * @param  string $clientID     First part of the App Key pair generated when creating an application in App Center.
     * @param  string $clientSecret Second part of the App Key pair generated when creating an application in App Center
     *
     * @return string|null Access token to be used in subsequent API requests
     */
    protected function getToken()
    {
        if (false === is_null($this->accessToken)) {
            return $this->accessToken;
        }

        return $this->accessToken = $this->token->request();
    }
}
