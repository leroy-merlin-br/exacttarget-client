<?php
namespace LeroyMerlin\ExactTarget;

use LeroyMerlin\ExactTarget\Exception\ActionNotFoundException;

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

    public function testToEndpointWithInvalidActionShouldThrowAnException()
    {
        $this->expectException(ActionNotFoundException::class);
        $this->expectExceptionMessage('The following action key does not exist in ServiceEnum::$actionList: invalid-action');

        ServiceEnum::toEndpoint('invalid-action');
    }

    /**
     * Retrieves valid endpoints
     */
    public function getEndpoints()
    {
        return [
            [
                'requestToken',
                [
                    'method'    => 'post',
                    'action'    => 'requestToken',
                    'subdomain' => 'auth',
                    'service'   => null,
                ],
            ],
            [
                'addDataExtensionRow',
                [
                    'method'    => 'post',
                    'subdomain' => 'www',
                    'action'    => 'dataevents/key:{key}/rowset',
                    'service'   => 'hub',
                ],
            ],
        ];
    }
}
