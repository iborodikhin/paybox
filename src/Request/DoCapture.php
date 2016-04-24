<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Do capture request.
 */
class DoCapture extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return self::URL_DO_CAPTURE;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Paybox\Response\DoCapture
     */
    public function getResponse()
    {
        return new Response\DoCapture();
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
            'pg_long_record',
        ];
    }
}