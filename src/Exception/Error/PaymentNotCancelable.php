<?php
namespace Paybox\Exception\Error;

/**
 * Cannot cancel payment exception.
 */
class PaymentNotCancelable extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 490;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Cannot cancel payment.';
}
