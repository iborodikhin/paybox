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
        return '/cancel.php';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getResponseClassName()
    {
        return '\\Paybox\\Response\\Cancel';
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
