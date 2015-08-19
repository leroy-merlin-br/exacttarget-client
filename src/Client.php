<?php
namespace LeroyMerlin\ExactTarget;

/**
 * This class is responsible to make the calls to ExactTarget API.
 */
class Client
{
    /**
     * OAuth token passed to API requests.
     *
     * @var string
     */
    protected $accessToken;

    /**
     * Constructor
     *
     * @param Token          $token
     * @param RequestBuilder $requestBuilder
     */
    public function __construct(Token $token, RequestBuilder $requestBuilder)
    {
        $this->token          = $token;
        $this->requestBuilder = $requestBuilder;
        $this->urlBuilder     = new UrlBuilder();
    }

    /**
     * Executes a service listed on ServiceEnum class.
     *
     * @param  string $action
     * @param  array  $arguments
     *
     * @throws \LeroyMerlin\ExactTarget\Exception\ActionNotFoundException
     * @throws \LeroyMerlin\ExactTarget\Exception\RequestException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __call($action, $arguments)
    {
        $token      = $this->getToken();
        $actionInfo = ServiceEnum::toEndpoint($action);

        $parameters = count($arguments) ? $arguments[0] : [];
        $data       = isset($parameters['data']) ? $parameters['data'] : [];

        return $this->requestBuilder->request(
            $this->urlBuilder->build(
                $actionInfo['subdomain'],
                $actionInfo['action'],
                $actionInfo['service'],
                $parameters
            ),
            $actionInfo['method'],
            [
                'json'    => $data,
                'headers' => ['Authorization' => 'Bearer ' . $token],
            ]
        );
    }

    /**
     * Obtain and stores the OAuth token from ExactTarget. Even tought this
     * method returns the Access token, it will be stored within the instance
     * for future requests.
     *
     * @return string Access token to be used in subsequent API requests
     */
    protected function getToken()
    {
        if (false === is_null($this->accessToken)) {
            return $this->accessToken;
        }

        $response = json_decode(
            (string) $this->token->request()->getBody(),
            true
        );

        return $this->accessToken = $response['accessToken'];
    }
}
