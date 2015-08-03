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

        return $instance->actionList[$action];
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
