<?php
namespace Paybox\Exception\Error;

/**
 * Transaction is locked exception.
 */
class TransactionLocked extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 350;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Transaction is locked.';
}
