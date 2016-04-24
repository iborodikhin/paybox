<?php
namespace Paybox;

use Buzz\Browser;
use Buzz\Client\Curl;
use Paybox\Exception\Configuration;

/**
 * Paybox client.
 */
class Client
{
    /**
     * Currencies.
     */
    const CURRENCY_RUB = 'RUR';
    const CURRENCY_USD = 'USD';
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_KZT = 'KZT';

    /**
     * Client browser.
     *
     * @var \Buzz\Browser
     */
    protected $browser;

    /**
     * Client options.
     *
     * @var array
     */
    protected $options;

    /**
     * Client constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->verifyArray($options, ['scheme', 'host', 'secret']);

        $this->options = array_replace_recursive([
            'timeout' => 30,
        ], $options);

        $client = new Curl();
        $client->setTimeout($this->options['timeout']);

        $this->browser = new Browser($client);
    }

    /**
     * Initialize payment.
     *
     * @param  float                        $amount
     * @param  string                       $paymentSystem
     * @param  string                       $description
     * @return \Paybox\Response\InitPayment
     */
    public function initPayment($amount, $paymentSystem, $description)
    {
        $cmd = new Request\InitPayment($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);
        $cmd->set('pg_amount', $amount);
        $cmd->set('pg_payment_system', $paymentSystem);
        $cmd->set('pg_description', $description);

        return $cmd->getResponse();
    }

    /**
     * Gets payment systems list.
     *
     * @param  float                                  $amount
     * @return \Paybox\Response\GetPaymentSystemsList
     */
    public function getPaymentSystemsList($amount)
    {
        $cmd = new Request\GetPaymentSystemsList($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);
        $cmd->set('pg_amount', $amount);

        return $cmd->getResponse();
    }

    /**
     * Verifies that array has all mandatory fields.
     *
     * @param  array                           $input
     * @param  array                           $mandatoryFields
     * @return boolean
     * @throws \Paybox\Exception\Configuration
     */
    protected function verifyArray(array $input, array $mandatoryFields)
    {
        foreach ($mandatoryFields as $field) {
            if (!array_key_exists($field, $input)) {
                throw new Configuration(sprintf('"%s" key is mandatory'));
            }
        }

        return true;
    }
}
