<?php
namespace Paybox\Response;

class InitPayment extends Base
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    protected function getFields()
    {
        return [
            'pg_payment_id',
            'pg_redirect_url',
            'pg_redirect_url_type',
            'pg_accepted_payment_systems',
            'pg_salt',
            'pg_sig',
        ];
    }
}
