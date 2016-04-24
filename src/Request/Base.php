<?php
namespace Paybox\Request;

use Buzz\Browser;
use Paybox\Entity;
use Paybox\Exception\Http;
use Paybox\Sign;
use Paybox\Xml;

/**
 * Base request class.
 */
abstract class Base extends Entity
{
    /**
     * Payout/refund systems.
     */
    const PAYOUT_SYSTEM_CONTACT = 'CONTACT_O';
    const PAYOUT_SYSTEM_YANDEXMONEY = 'YANDEXMONEY_O';
    const PAYOUT_SYSTEM_MOBILEPHONE = 'MOBILEPHONE_O';

    /**
     * Secret string for signing.
     *
     * @var null|string
     */
    protected $secret;

    /**
     * Paybox scheme.
     *
     * @var null|string
     */
    protected $scheme;

    /**
     * Paybox hostname.
     *
     * @var null|string
     */
    protected $host;

    /**
     * Buzz browser.
     *
     * @var \Buzz\Browser
     */
    protected $browser;

    /**
     * Returns request URL.
     *
     * @return string
     */
    abstract protected function getRequestUrl();

    /**
     * Returns corresponding response class name.
     *
     * @return string
     */
    abstract protected function getResponseClassName();

    /**
     * Constructor.
     *
     * @param \Buzz\Browser $browser
     * @param array         $options
     */
    public function __construct(Browser $browser, array $options)
    {
        $this->browser = $browser;
        $this->secret  = $options['secret'];
        $this->scheme  = $options['scheme'];
        $this->host    = $options['host'];
    }

    /**
     * Returns response for request.
     *
     * @return \Paybox\Response\Base
     */
    public function getResponse()
    {
        $response = $this->getRawResponse();
        $data     = $this->responseToArray($response);

        return call_user_func([$this->getResponseClassName(), 'factory'], $data);
    }

    /**
     * Returns raw response for request.
     *
     * @return string
     * @throws \Paybox\Exception\Http
     */
    protected function getRawResponse()
    {
        /** @var \Buzz\Message\Response $result */
        $uri    = sprintf('%s://%s%s', $this->scheme, $this->host, $this->getRequestUrl());
        $result = $this->browser->submit($uri, (new Sign($this->secret))->sign($uri, $this->toArray()));

        if ($result->isClientError() || $result->isServerError()) {
            if ($result->getStatusCode() >= 400) {
                throw new Http(
                    sprintf('Paybox responded with code %d: %s', $result->getStatusCode(), $result->getContent()),
                    $result->getStatusCode()
                );
            }
        }

        return $result->getContent();
    }

    /**
     * Parses response to array.
     *
     * @param  string $response
     * @return array
     */
    protected function responseToArray($response)
    {
        return (new Xml())->responseToArray($response);
    }

    /**
     * Returns salt for request.
     */
    protected function getSalt()
    {
        return implode('', [uniqid(), uniqid(), uniqid(), uniqid()]);
    }
}
