<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Payment initialization request.
 */
class InitPayment extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return '/init_payment.php';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getResponseClassName()
    {
        return '\\Paybox\\Response\\InitPayment';
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
            'pg_amount',
            'pg_currency',
            'pg_check_url',
            'pg_result_url',
            'pg_refund_url',
            'pg_capture_url',
            'pg_request_method',
            'pg_success_url',
            'pg_failure_url',
            'pg_success_url_method',
            'pg_failure_url_method',
            'pg_state_url',
            'pg_state_url_method',
            'pg_site_url',
            'pg_payment_system',
            'pg_lifetime',
            'pg_encoding',
            'pg_description',
            'pg_user_phone',
            'pg_user_contact_email',
            'pg_user_email',
            'pg_user_ip',
            'pg_postpone_payment',
            'pg_language',
            'pg_testing_mode',
            'pg_recurring_start',
            'pg_recurring_lifetime',
        ];
    }
}
