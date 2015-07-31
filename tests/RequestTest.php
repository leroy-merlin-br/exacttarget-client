<?php
namespace LeroyMerlin\ExactTarget;

use PHPUnit_Framework_TestCase as TestCase;

/**
* Test case for Request class
*/
class RequestTest extends TestCase
{
    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Not implemented yet!
     */
    public function testPerformRequestShouldHitEndpointSuccessfully()
    {
        (new Request())->call(null, null);
    }
}
