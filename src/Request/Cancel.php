<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Cancel request.
 */
class Cancel extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return self::URL_CANCEL;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Paybox\Response\Cancel
     */
    public function getResponse()
    {
        return new Response\Cancel();
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
        ];
    }
}
