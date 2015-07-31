<?php
namespace LeroyMerlin\ExactTarget;

/**
* This class is responsible to call API in order to get a token to authenticate
* next API requests
*/
class Token
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Constructor
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        return $this->request->call(
            'post',
            'requestToken',
            compact('clientId', 'clientSecret')
        );
    }
}
