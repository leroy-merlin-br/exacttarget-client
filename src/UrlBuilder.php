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
     * @param  array  $paramters
     *
     * @return string
     */
    public function build(
        $subdomain,
        $action,
        $service = null,
        array $parameters = []
    ) {
        if (false === is_null($service)) {
            $service  = '/'.$service;
        }

        $action = $this->replaceParameters($action, $parameters);

        return sprintf(self::ENDPOINT, $subdomain, $service, $action);
    }

    /**
     * Replace parameters in action var
     *
     * @param  array $parameters
     *
     * @return string
     */
    private function replaceParameters($action, $parameters)
    {
        foreach ($parameters as $key => $value) {
            $action = str_replace(sprintf('{%s}', $key), $value, $action);
        }

        return $action;
    }
}
