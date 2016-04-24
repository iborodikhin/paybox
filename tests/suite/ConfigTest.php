<?php
namespace Paybox\Test;

/**
 * Test test configuration.
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests test configuration.
     */
    public function testConfig()
    {
        $this->assertNotEmpty(getenv('merchant_id'));
        $this->assertNotEmpty(getenv('merchant_secret'));
        $this->assertNotEmpty(getenv('scheme'));
        $this->assertNotEmpty(getenv('host'));
    }
}
