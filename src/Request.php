<?php
namespace LeroyMerlin\ExactTarget;

/**
* This class is responsible to execute calls to SalesForce API.
*/
class Request
{
    const ENDPOINT = 'https://%s.exacttargetapis.com/v1/';

    /**
     * Will perform a $verb request to the given $endpoint with $parameters.
     * If anywhere in the url there is a name of a parameter within curly braces
     * they will be replaced by a $param with the same name containing a string
     * or int.
     *
     * @param  string $verb      May be get,delete,head,options,patch,post,put
     * @param  string $endpoint  Url where curly braces will be replaces, Ex: add/{id}/something
     * @param  array $parameters Array of parameters, Ex: ['id' => 5, 'name' => 'john doe']
     *
     * @return array Response data
     */
    public function call(
        $verb,
        $endpoint,
        array $parameters = [],
        $subdomain = 'www'
    ) {
        throw new \BadMethodCallException('Not implemented yet!');
    }
}
