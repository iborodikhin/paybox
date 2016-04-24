<?php
namespace Paybox\Response;

class GetPaymentSystemsList extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    protected function getFields()
    {
        return [
            'pg_payment_system',
            'pg_sig',
        ];
    }
}
