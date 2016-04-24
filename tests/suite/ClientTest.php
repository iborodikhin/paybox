<?php
namespace Paybox\Test;

use Paybox\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Paybox\Client
     */
    protected $client;

    /**
     * Test payment systems list request.
     */
    public function testGetPaymentSystemsListPositive()
    {
        $result = $this->client->getPaymentSystemsList(1000);

        $this->assertInstanceOf('\\Paybox\\Response\\GetPaymentSystemsList', $result);
        $this->assertArrayHasKey('pg_payment_system', $result->toArray());
    }

    /**
     * @expectedException \Paybox\Exception\Base
     */
    public function testGetPaymentSystemsListNegative()
    {
        $result = $this->client->getPaymentSystemsList("invalid-amount");
    }

    /**
     * Test payment initialization.
     */
    public function testInitPayment()
    {
        $result = $this->client->initPayment(1000, 'TESTCARD', 'test payment');

        $this->assertInstanceOf('\\Paybox\\Response\\InitPayment', $result);
        $this->assertArrayHasKey('pg_payment_id', $result->toArray());
        $this->assertArrayHasKey('pg_redirect_url', $result->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->client = new Client([
            'scheme'      => getenv('scheme'),
            'host'        => getenv('host'),
            'secret'      => getenv('merchant_secret'),
            'merchant_id' => getenv('merchant_id'),
        ]);
    }
}
