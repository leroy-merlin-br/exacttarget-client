<?php
namespace LeroyMerlin\ExactTarget\Exception;

use PHPUnit_Framework_TestCase as TestCase;

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
