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
     * Cancels payment.
     *
     * @param  string                  $paymentId
     * @return \Paybox\Response\Cancel
     */
    public function cancel($paymentId)
    {
        $cmd = new Request\Cancel($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);
        $cmd->set('pg_payment_id', $paymentId);

        return $cmd->getResponse();
    }

    /**
     * @todo
     *
     * @return \Paybox\Response\CancelPayout
     */
    public function cancelPayout()
    {
        $cmd = new Request\CancelPayout($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);

        return $cmd->getResponse();
    }

    /**
     * @todo
     *
     * @return \Paybox\Response\CreatePayout
     */
    public function createPayout()
    {
        $cmd = new Request\CreatePayout($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);

        return $cmd->getResponse();
    }

    /**
     * Creates refund request.
     *
     * @param  string                               $paymentId
     * @param  string                               $comment
     * @param  float                                $amount
     * @return \Paybox\Response\CreateRefundRequest
     */
    public function createRefundRequest($paymentId, $comment, $amount)
    {
        $cmd = new Request\CreateRefundRequest($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);
        $cmd->set('pg_payment_id', $paymentId);
        $cmd->set('pg_comment', $comment);
        $cmd->set('pg_refund_amount', $amount);

        return $cmd->getResponse();
    }

    /**
     * Captures card payment.
     *
     * @param  string                     $paymentId
     * @param  string                     $longRecord
     * @return \Paybox\Response\DoCapture
     */
    public function doCapture($paymentId, $longRecord)
    {
        $cmd = new Request\DoCapture($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);
        $cmd->set('pg_payment_id', $paymentId);
        $cmd->set('pg_long_record', $longRecord);

        return $cmd->getResponse();
    }

    /**
     * Retrieves payment status.
     *
     * @param  string|null                       $paymentId
     * @param  string|null                       $orderId
     * @return \Paybox\Response\GetPaymentStatus
     */
    public function getPaymentStatus($paymentId = null, $orderId = null)
    {
        $cmd = new Request\GetPaymentStatus($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);

        if (null !== $orderId && null === $paymentId) {
            $cmd->set('pg_order_id', $orderId);
        } elseif (null === $orderId && null !== $paymentId) {
            $cmd->set('pg_payment_id', $paymentId);
        }

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
     * @todo
     *
     * @return \Paybox\Response\GetPayoutStatus
     */
    public function getPayoutStatus()
    {
        $cmd = new Request\GetPayoutStatus($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);

        return $cmd->getResponse();
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
     * Makes recurring payment.
     *
     * @param  string                                $orderId
     * @param  mixed                                 $profile
     * @param  float                                 $amount
     * @param  string                                $description
     * @return \Paybox\Response\MakeRecurringPayment
     */
    public function makeRecurringPayment($orderId, $profile, $amount, $description)
    {
        $cmd = new Request\MakeRecurringPayment($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);
        $cmd->set('pg_order_id', $orderId);
        $cmd->set('pg_recurring_profile', $profile);
        $cmd->set('pg_amount', $amount);
        $cmd->set('pg_description', $description);

        return $cmd->getResponse();
    }

    /**
     * Revokes payment.
     *
     * @param  string                  $paymentId
     * @param  float                   $amount
     * @return \Paybox\Response\Revoke
     */
    public function revoke($paymentId, $amount)
    {
        $cmd = new Request\Revoke($this->browser, $this->options);

        $cmd->set('pg_merchant_id', $this->options['merchant_id']);
        $cmd->set('pg_payment_id', $paymentId);
        $cmd->set('pg_refund_amount', $amount);

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
