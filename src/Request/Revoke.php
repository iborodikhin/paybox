<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Revoke request.
 */
class Revoke extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return self::URL_REVOKE;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Paybox\Response\Revoke
     */
    public function getResponse()
    {
        return new Response\Revoke();
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
            'pg_refund_amount',
        ];
    }
}
