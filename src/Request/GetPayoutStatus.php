<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Get payout status request.
 */
class GetPayoutStatus extends BasePayout
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return '/get_payout_status.php';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getResponseClassName()
    {
        return '\\Paybox\\Response\\GetPayoutStatus';
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
