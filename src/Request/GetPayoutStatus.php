<?php
namespace Paybox\Request;

use Paybox\Response;

/**
 * Get payout status request.
 */
class GetPayoutStatus extends BasePayout
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function getRequestUrl()
    {
        return self::URL_GET_PAYOUT_STATUS;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Paybox\Response\GetPayoutStatus
     */
    public function getResponse()
    {
        $response = $this->getRawResponse();
        $data     = $this->responseToArray($response);

        return Response\GetPayoutStatus::factory($data);
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
            'payout_id',
        ];
    }
}
