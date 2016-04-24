<?php
namespace Paybox\Exception\Error;

/**
 * Action disabled exception.
 */
class ActionDisabled extends Base
{
    /**
     * {@inheritdoc}
     *
     * @var integer
     */
    protected $code = 130;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $message = 'Action is disabled in settings.';
}
