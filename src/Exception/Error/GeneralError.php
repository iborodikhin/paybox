<?php
namespace Paybox\Exception\Error;

/**
 * General error exception.
 */
class GeneralError extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 600;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'General error.';
}
