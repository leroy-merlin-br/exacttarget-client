<?php
namespace LeroyMerlin\ExactTarget;

use GuzzleHttp\ClientInterface;

/**
* This class is responsible to execute calls to SalesForce API.
*/
class Request
{
    /**
     * Base API url
     *
     * @var string
     */
    const ENDPOINT = 'https://%s.exacttargetapis.com/v1/%s';

    /**
     * Guzzle client to handle requests
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * Constructor
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Will perform a $verb request to the given $endpoint with $parameters.
     * If anywhere in the url there is a name of a parameter within curly braces
     * they will be replaced by a $param with the same name containing a string
     * or int.
     *
     * @param  string $verb      May be get,delete,head,options,patch,post,put
     * @param  string $action    Url where curly braces will be replaces, Ex: add/{id}/something
     * @param  array $parameters Array of parameters, Ex: ['id' => 5, 'name' => 'john doe']
     *
     * @return array Response data
     */
    public function call(
        $action,
        $verb = 'get',
        array $parameters = [],
        $subdomain = 'www'
    ) {
        return $this->client->request(
            $verb,
            sprintf(self::ENDPOINT, $subdomain, $action),
            $parameters
        );
    }
}
