<?php
namespace LeroyMerlin\ExactTarget\Exception;

/**
 * Exception to throw when url parameter is missing in API call
 */
class MissingUrlParameterException extends ExactTargetClientException
{
    /**
     * Constructor
     *
     * @param array $missingParameters
     */
    public function __construct(array $missingParameters)
    {
        parent::__construct(
            sprintf(
                'Missing following parameter(s): %s',
                implode(', ', $missingParameters)
            )
        );
    }
}
