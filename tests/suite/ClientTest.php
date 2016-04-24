<?php
namespace Paybox\Test;

use Paybox\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testScenario()
    {
        $client = new Client([
            'scheme'      => getenv('scheme'),
            'host'        => getenv('host'),
            'secret'      => getenv('merchant_secret'),
            'merchant_id' => getenv('merchant_id'),
        ]);

        $result = $client->getPaymentSystemsList(1000);
        $this->assertInstanceOf('\\Paybox\\Response\\GetPaymentSystemsList', $result);
        $this->assertArrayHasKey('pg_payment_system', $result->toArray());

        $psList = $result->toArray()['pg_payment_system'];
        $psItem = $psList[array_rand($psList)];

        $result = $client->initPayment(1000, $psItem['pg_name'], uniqid('test payment'), '77772444081');
        $this->assertInstanceOf('\\Paybox\\Response\\InitPayment', $result);
        $this->assertArrayHasKey('pg_payment_id', $result->toArray());
        $this->assertArrayHasKey('pg_redirect_url', $result->toArray());
    }
}
