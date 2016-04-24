<?php
namespace Paybox\Exception\Error;

/**
 * Internal error exception.
 */
class InternalError extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 1000;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Internal error.';
}
