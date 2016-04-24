<?php
namespace Paybox\Test;

use Paybox\Xml;

/**
 * XML transformations test.
 */
class XmlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test XML to array transformation.
     *
     * @dataProvider provideResponseToArray
     * @param string $xmlString
     * @param array  $expected
     */
    public function testResponseToArray($xmlString, $expected)
    {
        $actual = (new Xml())->responseToArray($xmlString);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test array to XML transformation.
     *
     * @dataProvider provideRequestToXml
     * @param array  $data
     * @param string $expected
     */
    public function testRequestToXml($data, $expected)
    {
        $actual   = (new Xml())->requestToXml($data);
        // Remove newline chars.
        $actual   = preg_replace('#[\n\r]#u', '', $actual);
        $expected = preg_replace('#[\n\r]#u', '', $expected);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Provide test data for XML to array transformation test.
     *
     * @return array
     */
    public function provideResponseToArray()
    {
        return [
            [
                '<?xml version="1.0" encoding="utf-8"?>' .
                '<response>' .
                    '<pg_status>ok</pg_status>' .
                    '<pg_param1>value1</pg_param1>' .
                    '<pg_param2>value2</pg_param2>' .
                    '<pg_param3>value3</pg_param3>' .
                '</response>',
                [
                    'pg_status' => 'ok',
                    'pg_param1' => 'value1',
                    'pg_param2' => 'value2',
                    'pg_param3' => 'value3',
                ],
            ],
            [
                '<?xml version="1.0" encoding="utf-8"?>' .
                '<response>' .
                    '<pg_salt>9imM909TH820jwk387</pg_salt>' .
                    '<pg_t_param>value3</pg_t_param>' .
                    '<pg_a_param>value1</pg_a_param>' .
                    '<pg_z_param>' .
                        '<pg_q_subparam>subvalue2</pg_q_subparam>' .
                        '<pg_m_subparam>subvalue1</pg_m_subparam>' .
                    '</pg_z_param>' .
                    '<pg_b_param>value2</pg_b_param>' .
                    '<pg_sig>74aa41a4f425d124a23c3a53a3140bdc15826</pg_sig>' .
                '</response>',
                [
                    'pg_salt'    => '9imM909TH820jwk387',
                    'pg_t_param' => 'value3',
                    'pg_a_param' => 'value1',
                    'pg_z_param' => [
                        'pg_q_subparam' => 'subvalue2',
                        'pg_m_subparam' => 'subvalue1',
                    ],
                    'pg_b_param' => 'value2',
                    'pg_sig'     => '74aa41a4f425d124a23c3a53a3140bdc15826',
                ],
            ],
        ];
    }

    /**
     * Provide test data for array to XML transformation test.
     *
     * @return array
     */
    public function provideRequestToXml()
    {
        return [
            [
                [
                    'pg_status' => 'ok',
                    'pg_param1' => 'value1',
                    'pg_param2' => 'value2',
                    'pg_param3' => 'value3',
                ],
                '<?xml version="1.0" encoding="utf-8"?>' .
                '<request>' .
                    '<pg_status>ok</pg_status>' .
                    '<pg_param1>value1</pg_param1>' .
                    '<pg_param2>value2</pg_param2>' .
                    '<pg_param3>value3</pg_param3>' .
                '</request>',
            ],
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
                    'pg_sig'     => '74aa41a4f425d124a23c3a53a3140bdc15826',
                ],
                '<?xml version="1.0" encoding="utf-8"?>' .
                '<request>' .
                    '<pg_salt>9imM909TH820jwk387</pg_salt>' .
                    '<pg_t_param>value3</pg_t_param>' .
                    '<pg_a_param>value1</pg_a_param>' .
                    '<pg_z_param>' .
                        '<pg_q_subparam>subvalue2</pg_q_subparam>' .
                        '<pg_m_subparam>subvalue1</pg_m_subparam>' .
                    '</pg_z_param>' .
                    '<pg_b_param>value2</pg_b_param>' .
                    '<pg_sig>74aa41a4f425d124a23c3a53a3140bdc15826</pg_sig>' .
                '</request>',
            ],
        ];
    }
}
