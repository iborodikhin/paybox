<?php
namespace Paybox\Exception\Error;

/**
 * Action or contract missing exception.
 */
class ActionOrContractMissing extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 110;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Action or contract missing.';
}
