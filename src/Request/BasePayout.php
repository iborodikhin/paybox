<?php
namespace Paybox\Request;
use Paybox\Exception\Http;

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
     * {@inheritdoc}
     *
     * @return string
     * @throws \Paybox\Exception\Http
     */
    protected function getRawResponse()
    {
        /** @var \Buzz\Message\Response $result */
        $uri    = sprintf('%s://%s%s', $this->scheme, $this->host, $this->getRequestUrl());
        $result = $this->browser->submit($uri, array_merge(
            $this->toArray(),
            ['token' => $this->getToken(), 'signature_for_verifier' => $this->getSignature()]
        ));

        if ($result->isClientError() || $result->isServerError()) {
            if ($result->getStatusCode() >= 400) {
                throw new Http(
                    sprintf('Paybox responded with code %d: %s', $result->getStatusCode(), $result->getContent()),
                    $result->getStatusCode()
                );
            }
        }

        return $result->getContent();
    }

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
