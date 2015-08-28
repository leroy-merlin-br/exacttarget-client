<?php
namespace LeroyMerlin\ExactTarget;

use LeroyMerlin\ExactTarget\Exception\RequestException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException as GuzzleException;

/**
 * This class is responsible to execute calls to SalesForce API.
 */
class RequestBuilder
{
    /**
     * Guzzle client to handle requests
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * Constructor
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Will perform a $verb request to the given $endpoint with $parameters.
     *
     * @param  string $endpoint   Url where curly braces will be replaces, Ex: add/{id}/something
     * @param  string $verb       May be get, delete, head, options, patch, post, put
     * @param  array  $parameters Array of parameters, Ex: ['id' => 5, 'name' => 'john doe']
     *
     * @throws RequestException
     *
     * @return array Response data
     */
    public function request(
        $endpoint,
        $verb = 'get',
        array $parameters = []
    ) {
        try {
            return $this->client->request($verb, $endpoint, $parameters);
        } catch (GuzzleException $error) {
            throw new RequestException(
                (string) $error->getResponse()->getBody(),
                $error->getCode()
            );
        }
    }
}
