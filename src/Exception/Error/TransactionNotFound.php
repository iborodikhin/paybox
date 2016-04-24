<?php
namespace Paybox\Exception\Error;

/**
 * Transaction not found exception.
 */
class TransactionNotFound extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 340;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Transaction not found.';
}
