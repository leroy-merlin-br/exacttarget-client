<?php
namespace LeroyMerlin\ExactTarget\Exception;

/**
 * Exception to throw when action do not exists
 */
class ActionNotFoundException extends ExactTargetClientException
{
    /**
     * Constructor
     *
     * @param string $action Action that does not exist
     */
    public function __construct($action)
    {
        parent::__construct(
            'The following action key does not exist in ' .
            'ServiceEnum::$actionList: ' . $action
        );
    }
}
