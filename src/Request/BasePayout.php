<?php
namespace Paybox\Request;

/**
 * Base payout request.
 */
abstract class BasePayout extends Base
{
    /**
     * Status codes.
     */
    const STATUS_ERROR_AUTH = 2;
    const STATUS_ERROR_DATA = 1;
    const STATUS_OK = 0;

    /**
     * Paybox node id.
     */
    const PAYBOX_NODE_ID = 2;

    /**
     * Verifier node id.
     */
    const VERIFIER_NODE_ID = 1;

    /**
     * Generates token for request.
     *
     * @return string
     */
    protected function getToken()
    {
        return sha1(sprintf(
            'from=%s;to=%s;%s',
            $this->get('node_id'),
            self::PAYBOX_NODE_ID,
            $this->secret
        ));
    }

    /**
     * Generates signature for request.
     *
     * @return string
     */
    protected function getSignature()
    {
        return md5(implode(
            ';',
            [
                $this->get('node_id'),
                self::PAYBOX_NODE_ID,
                self::VERIFIER_NODE_ID,
                sha1($this->getToken()),
            ]
        ));
    }

    /**
     * {@inheritdoc}
     *
     * @param  string $response
     * @return array
     */
    protected function responseToArray($response)
    {
        return json_decode($response, true);
    }
}
