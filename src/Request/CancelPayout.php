<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Cancel payout request.
 */
class CancelPayout extends BasePayout
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return '/cancel_payout.php';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getResponseClassName()
    {
        return '\\Paybox\\Response\\CancelPayout';
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    protected function getFields()
    {
        return [
            'node_id',
            'token',
            'payout_id',
        ];
    }
}
