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
        return self::URL_MAKE_RECURRING_PAYMENT;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Paybox\Response\MakeRecurringPayment
     */
    public function getResponse()
    {
        $response = $this->getRawResponse();
        $data     = $this->responseToArray($response);

        return Response\MakeRecurringPayment::factory($data);
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
