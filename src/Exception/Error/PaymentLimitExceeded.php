<?php
namespace Paybox\Exception\Error;

/**
 * Payment limit exceeded exception.
 */
class PaymentLimitExceeded extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 420;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Payment limit exceeded.';
}
