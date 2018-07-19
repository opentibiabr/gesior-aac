<?php

### DONT TOUCH IN THIS CODE ###
### WORKING FINE 19/08/2006 ###
###       IVENSPONTES       ###
### github.com/ivenspontes/ ###

require_once 'custom_scripts/PagSeguroLibrary/PagSeguroLibrary.php';
require 'config/config.php';

$product_id = $_POST['pid'];
$account_name = $_POST['accname'];

if(!isset($product_id, $account_name) || !isset($config['pagseguro']['offers'][intval($product_id)])){
    die("invalid parameters");
}
else {

    $coinCount = $config['donate']['offers'][intval($product_id)];

    $paymentRequest = new PagSeguroPaymentRequest();
    $paymentRequest->addItem('1', $coinCount . " " . $config['pagseguro']['produtoNome'], 1, $product_id/100.0);
    $paymentRequest->setCurrency("BRL");
    $paymentRequest->setShippingType(3); //Not specified
    $paymentRequest->setShippingCost(0.0);
    $paymentRequest->setReference($account_name . "-" . $coinCount);
    $paymentRequest->setRedirectUrl($config['pagseguro']['urlRedirect']);
    $paymentRequest->addParameter('notificationURL', $config['pagseguro']['urlNotification']);

    try {

        $credentials = PagSeguroConfig::getAccountCredentials();
        $checkoutUrl = $paymentRequest->register($credentials);
        header('location:' . $checkoutUrl);

    } catch (PagSeguroServiceException $e) {
        die($e->getMessage());
    }
}

?>