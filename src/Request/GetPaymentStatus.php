<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Get payment status request.
 */
class GetPaymentStatus extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return self::URL_PAYMENT_STATUS;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Paybox\Response\GetPaymentStatus
     */
    public function getResponse()
    {
        return new Response\GetPaymentStatus();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    protected function getFields()
    {
        return [
            'pg_merchant_id',
            'pg_payment_id',
            'pg_order_id',
        ];
    }
}
