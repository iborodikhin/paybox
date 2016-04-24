<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Refund request creation request.
 */
class CreateRefundRequest extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return '/create_refund_request.php';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getResponseClassName()
    {
        return '\\Paybox\\Response\\CreateRefundRequest';
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
            'pg_comment',
            'pg_refund_amount',
            // Refund by phone number.
            'pg_payout_system',
            'pg_account',
            // Refund by transfer.
            'pg_destination_code',
            'pg_fio',
            // Refund by Yandex.Money
            'pg_destination_account',
        ];
    }
}
