<?php
namespace Paybox;

/**
 * XML transformation utility.
 */
class Xml
{
    /**
     * Transforms XML to array.
     *
     * @param  string $xmlString
     * @return array
     */
    public function responseToArray($xmlString)
    {
        $xml = simplexml_load_string($xmlString);

        return json_decode(json_encode($xml), true);
    }

    /**
     * Transforms array to XML.
     *
     * @param  array  $data
     * @return string
     */
    public function requestToXml(array $data)
    {
        $xml = new \SimpleXMLElement(sprintf(
            '<?xml version="1.0" encoding="%s"?><request></request>',
            'utf-8'
        ));

        $this->dataToXml($xml, $data);

        return $xml->asXML();
    }

    /**
     * Recursive function for transformation array to XML.
     *
     * @param \SimpleXMLElement $xml
     * @param mixed             $data
     */
    protected function dataToXml(\SimpleXMLElement $xml, $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $child = $xml->addChild($key);
                $this->dataToXml($child, $value);
            } else {
                $xml->addChild($key, $value);
            }
        }
    }
}
