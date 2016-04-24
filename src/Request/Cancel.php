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
        $response = $this->getRawResponse();
        $data     = $this->responseToArray($response);

        return Response\Cancel::factory($data);
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
