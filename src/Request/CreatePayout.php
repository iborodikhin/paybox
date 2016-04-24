<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Create payout request.
 */
class CreatePayout extends BasePayout
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return '/create_payout.php';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getResponseClassName()
    {
        return '\\Paybox\\Response\\CreatePayout';
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    protected function getFields()
    {
        return [
            'node_id',
            'token',
            'verifier_node_id',
            'signature_for_verifier',
            'amount',
            'description',
            'payout_system',
            'contract_id',
            // Refund by transfer.
            'destination_code',
            'fio',
            // Refund by Yandex.Money
            'destination_account',
        ];
    }
}
