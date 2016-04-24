<?php
namespace Paybox;

/**
 * Signing utility.
 */
class Sign
{
    /**
     * Secret key.
     *
     * @var string
     */
    protected $secret;

    /**
     * Sign constructor.
     *
     * @param string $secret
     */
    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    /**
     * Signs request.
     *
     * @param  string $uri
     * @param  array  $data
     * @return array
     */
    public function sign($uri, array $data)
    {
        $data['pg_salt'] = $this->getSalt();
        $data['pg_sig']  = $this->getSignature($this->getFilenameFromUri($uri), $data);

        return $data;
    }

    /**
     * Checks if signature is valid.
     *
     * @param  string  $uri
     * @param  array   $data
     * @return boolean
     */
    public function checkSignature($uri, array $data)
    {
        $signature = $data['pg_sig'];
        unset($data['pg_sig']);

        return strcmp($signature, $this->getSignature($this->getFilenameFromUri($uri), $data)) === 0;
    }

    /**
     * Creates signature for request.
     *
     * @param  string $filename
     * @param  array  $data
     * @return string
     */
    protected function getSignature($filename, array $data)
    {
        $data = $this->formatData($data);
        $sign = implode(';', array_merge([$filename], $data, [$this->secret]));

        return md5($sign);
    }

    /**
     * Extracts filename from URI.
     *
     * @param  string $uri
     * @return string
     */
    protected function getFilenameFromUri($uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);

        return basename($path);
    }

    /**
     * Creates random salt.
     *
     * @return string
     */
    protected function getSalt()
    {
        return uniqid();
    }

    /**
     * Sort array by key recursively.
     *
     * @param  array $data
     * @return array
     */
    protected function formatData(array $data)
    {
        ksort($data);

        $result = [];

        foreach ($data as $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->formatData($value));
            } else {
                $result[] = $value;
            }
        }

        return $result;

//        foreach ($data as $key => $value) {
//            if (is_array($value)) {
//                $value = $this->formatData($value);
//
//                foreach ($value as $key2 => $value2) {
//                    $data[$key2] = $value2;
//                }
//
//                unset($data[$key]);
//            }
//        }
//
//        return $data;
    }
}
