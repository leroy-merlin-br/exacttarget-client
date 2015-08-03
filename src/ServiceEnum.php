<?php
namespace LeroyMerlin\ExactTarget;

use LeroyMerlin\ExactTarget\Exception\ActionNotFoundException;

/**
* Enum to list all web service endpoints in exactarget API. This enum is
* responsible to 'translate' method names in endpoints
*/
class ServiceEnum
{
    /**
     * Instance to use singleton
     *
     * @var self
     */
    protected static $instance;

    /**
     * List all allowed services
     *
     * @var array
     */
    protected $actionList = [
        'requestToken' => [
            'method'    => 'post',
            'action'    => 'requestToken',
            'subdomain' => 'auth',
        ],
        'createContact' => [
            'method' => 'post',
            'action' => 'contacts',
        ],
    ];

    /**
     * @var array Default values when key do not exist in $actionList array
     */
    protected $defaultOptions = [
        'method'    => 'get',
        'subdomain' => 'www',
    ];

    /**
     * Translate the given action to corresponding webservice endpoint
     *
     * @param  string $action
     *
     * @throws ActionNotFoundException
     *
     * @return array
     */
    public static function toEndpoint($action)
    {
        $instance = self::getInstance();

        if (false === array_key_exists($action, $instance->actionList)) {
            throw new ActionNotFoundException($action);
        }

        return array_merge(
            $instance->defaultOptions,
            $instance->actionList[$action]
        );
    }

    /**
     * Retrieves a self instance
     *
     * @return self
     */
    protected static function getInstance()
    {
        if (false === is_null(self::$instance)) {
            return self::$instance;
        }

        return self::$instance = new self();
    }
}
