<?php
namespace LeroyMerlin\ExactTarget;

use LeroyMerlin\ExactTarget\Exception\MissingUrlParameterException;

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

        if ($missingParameters = $this->missingParameters($action)) {
            throw new MissingUrlParameterException($missingParameters);
        }

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

    private function missingParameters($action)
    {
        if (0 === preg_match_all("/\{([\w-]+)\}/i", $action, $matches)) {
            return [];
        }

        return $matches[1];
    }
}
