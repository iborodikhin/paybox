<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Payment systems list request.
 */
class GetPaymentSystemsList extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return '/ps_list.php';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getResponseClassName()
    {
        return '\\Paybox\\Response\\GetPaymentSystemsList';
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
            'pg_amount',
            'pg_currency',
            'pg_testing_mode',
        ];
    }
}
