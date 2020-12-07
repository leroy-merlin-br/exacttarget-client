<?php
namespace LeroyMerlin\ExactTarget\Exception;

use LeroyMerlin\ExactTarget\TestCase;

/**
 * Test case for MissingUrlParameterException class
 */
class MissingUrlParameterExceptionTest extends TestCase
{
    public function testConstructorShouldBuildMessageSuccessfully()
    {
        $this->assertEquals(
            'Missing following parameter(s): key, another-key',
            (new MissingUrlParameterException(['key', 'another-key']))
                ->getMessage()
        );
    }
}
