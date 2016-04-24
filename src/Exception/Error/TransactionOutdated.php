<?php
namespace Paybox\Exception\Error;

/**
 * Transaction is outdated exception.
 */
class TransactionOutdated extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 360;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Transaction is outdated.';
}
