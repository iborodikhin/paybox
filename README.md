# Paybox
Client library for Paybox.kz payment service.

# Installation

    composer require iborodikhin/paybox

## Usage example

   $client = new \Paybox\Client($options);
   
   var_dump($client->getPaymentSystemsList($amount));

