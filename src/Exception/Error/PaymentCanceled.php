<?php
namespace Paybox\Exception\Error;

/**
 * Payment is canceled exception.
 */
class PaymentCanceled extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 400;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Payment is canceled.';
}
