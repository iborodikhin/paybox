# Paybox
Client library for Paybox.kz.

## Installation

    composer require iborodikhin/paybox

## Usage example

    $client = new \Paybox\Client($options);
    
    var_dump($client->getPaymentSystemsList($amount));
