<?php
namespace Paybox\Exception\Error;

/**
 * Not valid with payment system phone number exception.
 */
class InvalidPhoneNumber extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 711;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Phone number is not valid with payment system.';
}
