<?php
namespace LeroyMerlin\ExactTarget;

use LeroyMerlin\ExactTarget\Exception\MissingUrlParameterException;

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

    public function testBuildUrlWithCustomParametersShouldReturnUrlSuccessfully()
    {
        $parameters = [
            'key'         => 'some-key',
            'primaryKeys' => 'Key:Value',
            'useless-key' => 'Useless value',
        ];
        $subdomain  = 'www';
        $action     = 'dataevents/key:{key}/{primaryKeys}';
        $service    = 'hub';
        $this->assertEquals(
            sprintf(
                'https://www.exacttargetapis.com/hub/v1/dataevents/key:%s/%s',
                $parameters['key'],
                $parameters['primaryKeys']
            ),
            (new UrlBuilder())->build(
                $subdomain,
                $action,
                $service,
                $parameters
            )
        );
    }

    public function testBuildUrlWithMissingParametersShouldThrowException()
    {
        $parameters = ['useful-key' => 'Useful value'];
        $subdomain  = 'www';
        $action     = 'dataevents/key:{key}/{another-key}/useful:{useful-key}';

        $this->expectException(MissingUrlParameterException::class);
        $this->expectExceptionMessage('Missing following parameter(s): key, another-key');

        (new UrlBuilder())->build($subdomain, $action, null, $parameters);
    }
}
