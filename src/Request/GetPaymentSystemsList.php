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
        return self::URL_PAYMENT_SYSTEMS_LIST;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Paybox\Response\GetPaymentSystemsList
     */
    public function getResponse()
    {
        $response = $this->getRawResponse();
        $data     = $this->responseToArray($response);

        return Response\GetPaymentSystemsList::factory($data);
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
