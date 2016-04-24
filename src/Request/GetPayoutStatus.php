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
        return self::URL_GET_PAYOUT_STATUS;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Paybox\Response\GetPayoutStatus
     */
    public function getResponse()
    {
        return new Response\GetPayoutStatus();
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
