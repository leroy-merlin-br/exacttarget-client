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
     * Constructor.
     *
     * @param Token $token
     * @param RequestBuidler $requestBuilder
     */
    public function __construct(Token $token, RequestBuilder $requestBuilder)
    {
        $this->token          = $token;
        $this->requestBuilder = $requestBuilder;
    }

    /**
     * Executes a service listed on ServiceEnum class.
     *
     * @param  string $action
     * @param  mixed  $arguments
     *
     * @throws LeroyMerlin\ExactTarget\Exception\ActionNotFoundException
     * @throws LeroyMerlin\ExactTarget\Exception\RequestException
     *
     * @return Psr7\Http\Message\ResponseInterface
     */
    public function __call($action, $arguments)
    {
        $token      = $this->getToken();
        $actionInfo = ServiceEnum::toEndpoint($action);

        return $this->requestBuilder->request(
            $actionInfo['action'],
            $actionInfo['method'] ?: 'get',
            array_merge($arguments[0], ['Authorization' => 'Bearer '.$token]),
            'www'
        );
    }

    /**
     * Obtain and stores the OAuth token from ExactTarget. Even tought this
     * method retuns the Access token, it will be stored within the instance
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
            $this->token->request()->getResponse()->getBody(),
            true
        );

        return $this->accessToken = $response['accessToken'];
    }
}
