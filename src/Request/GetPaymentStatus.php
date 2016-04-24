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
        return '/get_status.php';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getResponseClassName()
    {
        return '\\Paybox\\Response\\GetPaymentStatus';
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
