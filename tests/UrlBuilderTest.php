<?php
namespace LeroyMerlin\ExactTarget;

use PHPUnit_Framework_TestCase as TestCase;

/**
* Class to generate API endpoint by the given action
*/
class UrlBuilderTest extends TestCase
{
    public function testBuildShouldCreateUrlWithoutService()
    {
        $subdomain = 'auth';
        $action    = 'requestToken';
        $this->assertEquals(
            'https://auth.exacttargetapis.com/v1/requestToken',
            (new UrlBuilder())->build($subdomain, $action)
        );
    }

    public function testBuildShouldCreateUrlWithService()
    {
        $subdomain = 'www';
        $action    = 'contacts';
        $service   = 'contacts';
        $this->assertEquals(
            'https://www.exacttargetapis.com/contacts/v1/contacts',
            (new UrlBuilder())->build($subdomain, $action, $service)
        );
    }
}
