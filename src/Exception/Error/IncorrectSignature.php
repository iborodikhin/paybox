<?php
namespace Paybox\Exception\Error;

/**
 * Incorrect signature exception.
 */
class IncorrectSignature extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 100;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Incorrect signature.';
}
