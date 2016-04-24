<?php
namespace Paybox\Exception\Error;

/**
 * Incorrect phone number exception.
 */
class IncorrectPhoneNumber extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 701;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Incorrect phone number.';
}
