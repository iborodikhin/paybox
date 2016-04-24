<?php
namespace Paybox\Exception\Error;

/**
 * Incorrect customer data exception.
 */
class IncorrectCustomerData extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 700;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Incorrect customer data.';
}
