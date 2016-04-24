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
        return self::URL_CANCEL_PAYOUT;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Paybox\Response\CancelPayout
     */
    public function getResponse()
    {
        return new Response\CancelPayout();
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
