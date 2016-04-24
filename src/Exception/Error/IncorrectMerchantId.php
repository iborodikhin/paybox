<?php
namespace Paybox\Exception\Error;

/**
 * Incorrect merchant id exception.
 */
class IncorrectMerchantId extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 101;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Incorrect merchant id.';
}
