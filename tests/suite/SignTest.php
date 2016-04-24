<?php
namespace Paybox\Test;

use Paybox\Sign;

/**
 * Sign class tests.
 */
class SignTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test filename extraction from URI.
     *
     * @dataProvider provideGetFilenameFromUri
     * @param string $uri
     * @param string $expected
     */
    public function testGetFilenameFromUri($uri, $expected)
    {
        $sign = new Sign('1');
        $refl = new \ReflectionMethod($sign, 'getFilenameFromUri');
        $refl->setAccessible(true);

        $this->assertEquals($expected, $refl->invoke($sign, $uri));
    }

    /**
     * Test if generated signature is correct.
     *
     * @dataProvider provideSign
     * @param string $uri
     * @param array  $data
     */
    public function testSign($uri, $data)
    {
        $sign   = new Sign('1');
        $actual = $sign->sign($uri, $data);

        $this->assertInternalType('array', $actual);
        $this->assertArrayHasKey('pg_salt', $actual);
        $this->assertArrayHasKey('pg_sig', $actual);

        $this->assertTrue($sign->checkSignature($uri, $actual));
    }

    /**
     * Test signature generation.
     *
     * @dataProvider provideGetSignature
     * @param string $filename
     * @param string $secret
     * @param array  $data
     * @param string $expected
     */
    public function testGetSignature($filename, $secret, $data, $expected)
    {
        $sign = new Sign($secret);
        $refl = new \ReflectionMethod($sign, 'getSignature');
        $refl->setAccessible(true);

        $this->assertEquals($expected, $refl->invoke($sign, $filename, $data));
    }

    /**
     * Test data formatting.
     *
     * @dataProvider provideFormatData
     * @param array $data
     * @param array $expected
     */
    public function testFormatData($data, $expected)
    {
        $sign = new Sign('1');
        $refl = new \ReflectionMethod($sign, 'formatData');
        $refl->setAccessible(true);

        $actual = $refl->invoke($sign, $data);
        $this->assertInternalType('array', $actual);
        $this->assertEquals(implode(';', $expected), implode(';', $actual));
    }

    /**
     * Provide test data for filename extraction from URI.
     *
     * @return array
     */
    public function provideGetFilenameFromUri()
    {
        return [
            ['http://example.com/', ''],
            ['http://example.com/script.php', 'script.php'],
            ['http://example.com/script.php?some=args', 'script.php'],
        ];
    }

    /**
     * Provide test data for sign.
     *
     * @return array
     */
    public function provideSign()
    {
        return [
            [
                'http://example.com/script.php',
                [
                    'pg_salt'    => '9imM909TH820jwk387',
                    'pg_t_param' => 'value3',
                    'pg_a_param' => 'value1',
                    'pg_z_param' => [
                        'pg_q_subparam' => 'subvalue2',
                        'pg_m_subparam' => 'subvalue1',
                    ],
                    'pg_b_param' => 'value2',
                ],
            ],
        ];
    }

    /**
     * Provide test data for signature generation.
     *
     * @return array
     */
    public function provideGetSignature()
    {
        return [
            [
                'script.php',
                'mypasskey',
                [
                    'pg_salt'    => '9imM909TH820jwk387',
                    'pg_t_param' => 'value3',
                    'pg_a_param' => 'value1',
                    'pg_z_param' => [
                        'pg_q_subparam' => 'subvalue2',
                        'pg_m_subparam' => 'subvalue1',
                    ],
                    'pg_b_param' => 'value2',
                ],
                'a8a4d5a9188f24038a14a4d65c387bf7',
            ],
        ];
    }

    /**
     * Provide test data for data formatting.
     *
     * @return array
     */
    public function provideFormatData()
    {
        return [
            [
                [
                    'pg_salt'    => '9imM909TH820jwk387',
                    'pg_t_param' => 'value3',
                    'pg_a_param' => 'value1',
                    'pg_z_param' => [
                        'pg_q_subparam' => 'subvalue2',
                        'pg_m_subparam' => 'subvalue1',
                    ],
                    'pg_b_param' => 'value2',
                ],
                [
                    'pg_a_param'    => 'value1',
                    'pg_b_param'    => 'value2',
                    'pg_salt'       => '9imM909TH820jwk387',
                    'pg_t_param'    => 'value3',
                    'pg_m_subparam' => 'subvalue1',
                    'pg_q_subparam' => 'subvalue2',
                ],
            ],
        ];
    }
}
