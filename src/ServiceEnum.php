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
     * List all allowed services
     *
     * @var array
     */
    protected static $actionList = [
        'requestToken'        => [
            'method'    => 'post',
            'action'    => 'requestToken',
            'subdomain' => 'auth',
        ],
        'addDataExtensionRow' => [
            'method'  => 'post',
            'service' => 'hub',
            'action'  => 'dataevents/key:{key}/rowset',
        ],
        'validateEmail' => [
            'method'    => 'post',
            'service'   => 'address',
            'action'    => 'validateEmail',
        ]
    ];

    /**
     * @var array Default values when key do not exist in $actionList array
     */
    protected static $defaultOptions = [
        'method'    => 'get',
        'subdomain' => 'www',
        'service'   => null,
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
        if (false === array_key_exists($action, self::$actionList)) {
            throw new ActionNotFoundException($action);
        }

        return array_merge(self::$defaultOptions, self::$actionList[$action]);
    }
}
