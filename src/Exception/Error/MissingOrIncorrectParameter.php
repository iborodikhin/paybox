<?php
namespace Paybox\Exception\Error;

/**
 * Request parameter missing or incorrect exception.
 */
class MissingOrIncorrectParameter extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 200;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Request parameter is missing or incorrect.';
}
