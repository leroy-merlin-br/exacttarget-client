<?php
namespace LeroyMerlin\ExactTarget;

/**
* Class to generate API endpoint by the given parameters
*/
class UrlBuilder
{
    /**
     * Base API url
     *
     * @var string
     */
    const ENDPOINT = 'https://%s.exacttargetapis.com%s/v1/%s';

    /**
     * Generates corresponding API endpoint
     *
     * @param  string $subdomain
     * @param  string $action
     * @param  string $service
     *
     * @return string
     */
    public function build($subdomain, $action, $service = null)
    {
        if (false === is_null($service)) {
            $service  = '/'.$service;
        }

        return sprintf(self::ENDPOINT, $subdomain, $service, $action);
    }
}
