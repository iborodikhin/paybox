<?php
namespace Paybox\Test;

/**
 * Entity class test.
 */
class EntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test setters and getters.
     *
     * @dataProvider provideSetGet
     * @param string $field
     * @param array  $fields
     */
    public function testSetGet($field, $fields)
    {
        /** @var \Paybox\Entity $mock */
        $mock = $this->getMockForAbstractClass('\\Paybox\\Entity');
        $mock->method('getFields')->willReturn($fields);

        $value  = uniqid();
        $actual = $mock->set($field, $value);
        $this->assertInstanceOf('\\Paybox\\Entity', $actual);

        $this->assertEquals($value, $mock->get($field));
    }

    /**
     * Test fromArray and toArray methods.
     *
     * @dataProvider provideToArray
     * @param array $input
     */
    public function testToArray($input)
    {
        /** @var \Paybox\Entity $mock */
        $mock = $this->getMockForAbstractClass('\\Paybox\\Entity');
        $mock->method('getFields')->willReturn(array_keys($input));

        foreach ($input as $key => $value) {
            $mock->set($key, $value);
        }

        $this->assertInternalType('array', $mock->toArray());
        $this->assertEquals($input, $mock->toArray());
    }

    /**
     * Data-provider.
     *
     * @return array
     */
    public function provideSetGet()
    {
        return [
            ['field1', ['field1', 'field2', 'field3']],
        ];
    }

    /**
     * Data-provider.
     *
     * @return array
     */
    public function provideToArray()
    {
        return [
            [[uniqid() => rand(), uniqid() => rand()]]
        ];
    }
}
