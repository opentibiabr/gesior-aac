<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 24/03/2018
 * Time: 18:58
 */

require_once "paypal_config.php";

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

// Get payment object by passing paymentId
if (isset($_REQUEST['paymentID'])) {
	$paymentId = $_REQUEST['paymentID'];
}

$payment = Payment::get($paymentId, $apiContext);
if (isset($_REQUEST['payerID'])) {
	$payerId = $_REQUEST['payerID'];
}

// Execute payment with payer id
$execution = new PaymentExecution();
$execution->setPayerId($payerId);

try {
	// Execute payment
	$result = $payment->execute($execution, $apiContext);
	echo $result;
} catch (PayPal\Exception\PayPalConnectionException $ex) {
	echo $ex->getCode();
	echo $ex->getData();
	die($ex);
} catch (Exception $ex) {
	die($ex);
}
