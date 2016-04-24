<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * request to make recurring payment.
 */
class MakeRecurringPayment extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return '/make_recurring_payment.php';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getResponseClassName()
    {
        return '\\Paybox\\Response\\MakeRecurringPayment';
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
            'pg_order_id',
            'pg_recurring_profile',
            'pg_amount',
            'pg_result_url',
            'pg_refund_url',
            'pg_request_method',
            'pg_encoding',
            'pg_description',
        ];
    }
}
