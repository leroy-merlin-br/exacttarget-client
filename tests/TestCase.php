<?php
namespace LeroyMerlin\ExactTarget;

use Mockery as m;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function tearDown(): void
    {
        $this->addToAssertionCount(m::getContainer()->mockery_getExpectationCount());
        m::close();
        parent::tearDown();
    }
}
