<?php
namespace LeroyMerlin\ExactTarget;

use PHPUnit_Framework_TestCase as TestCase;

/**
* Test case for ServiceEnum class
*/
class ServiceEnumTest extends TestCase
{
    /**
     * @dataProvider getEndpoints
     */
    public function testToEndpointShouldRetrieveCorrespondingEndpointInfo(
        $action,
        array $expected
    ) {
        $this->assertEquals(
            $expected,
            ServiceEnum::toEndpoint($action)
        );
    }

    /**
     * @expectedException LeroyMerlin\ExactTarget\Exception\ActionNotFoundException
     * @expectedExceptionMessage The following action key does not exist in ServiceEnum::$actionList: invalid-action
     */
    public function testToEndpointWithInvalidActionShouldThrowAnException()
    {
        ServiceEnum::toEndpoint('invalid-action');
    }

    /**
     * Retrieves valid endpoints
     */
    public function getEndpoints()
    {
        return [
            ['requestToken', [
                'method' => 'post',
                'action' => 'requestToken',
                'subdomain' => 'auth'
            ]],
            ['createContact', [
                'method' => 'post',
                'action' => 'contacts',
            ]],
        ];
    }
}
