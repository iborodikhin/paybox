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
     * URLs.
     */
    const URL_INIT_PAYMENT = '/init_payment.php';
    const URL_PAYMENT_SYSTEMS_LIST = '/ps_list.php';
    const URL_PAYMENT_STATUS = '/get_status.php';
    const URL_MAKE_RECURRING_PAYMENT = '/make_recurring_payment.php';
    const URL_DO_CAPTURE = '/do_capture.php';
    const URL_REVOKE = '/revoke.php';
    const URL_CREATE_REFUND_REQUEST = '/create_refund_request.php';
    const URL_CANCEL = '/cancel.php';
    const URL_CREATE_PAYOUT = '/create_payout.php';
    const URL_GET_PAYOUT_STATUS = '/get_payout_status.php';
    const URL_CANCEL_PAYOUT = '/cancel_payout.php';

    /**
     * Payout/refund systems.
     */
    const PAYOUT_SYSTEM_CONTACT = 'CONTACT_O';
    const PAYOUT_SYSTEM_YANDEXMONEY = 'YANDEXMONEY_O';
    const PAYOUT_SYSTEM_MOBILEPHONE = 'MOBILEPHONE_O';

    /**
     * Request URL.
     *
     * @var string
     */
    protected $requestUrl;

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
     * Returns response for request.
     *
     * @return \Paybox\Response\Base
     */
    abstract public function getResponse();

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
