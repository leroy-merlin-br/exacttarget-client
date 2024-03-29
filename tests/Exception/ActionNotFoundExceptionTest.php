<?php
namespace LeroyMerlin\ExactTarget\Exception;

use LeroyMerlin\ExactTarget\TestCase;

/**
 * Test case for ActionNotFoundException class
 */
class ActionNotFoundExceptionTest extends TestCase
{
    public function testConstructShouldSetACustomMessageForActionNotFound()
    {
        $this->assertEquals(
            'The following action key does not exist in ' .
            'ServiceEnum::$actionList: invalid-action',
            (new ActionNotFoundException('invalid-action'))->getMessage()
        );
    }
}
