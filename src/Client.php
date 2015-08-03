<?php
namespace LeroyMerlin\ExactTarget;

class Client
{
    const ENDPOINT = 'https://auth.exacttargetapis.com/v1/';

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

        $this->app = $app;
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
    }

    /**
     * Will perform a $verb request to the given $url with $params.
     * If anywhere in the url there is a name of a parameter within curly braces
     * they will be replaced by a $param with the same name containing a string
     * or int.
     *
     * @param  string $verb  May be get,delete,head,options,patch,post,put
     * @param  string $url   Url where curly braces will be replaces, Ex: add/{id}/something
     * @param  array $params Array of parameters, Ex: ['id' => 5, 'name' => 'john doe']
     *
     * @return array Response data
     */
    protected function performRequest($verb, $url, $params)
    {

        return $this->accessToken = $this->token->request();
    }
}
