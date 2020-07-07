<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 25/03/2018
 * Time: 00:05
 */
//require 'config/config.php';
require_once "paypal_config.php";
/**
 * comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
 */
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);
/**
 * true = show sent queries and SQL queries status/status code/error message
 */
define('DEBUG_DATABASE', false);
define('INITIALIZED', true);
if (!defined('ONLY_PAGE')) {
	define('ONLY_PAGE', true);
}
/**
 * check if site is disabled/requires installation
 */
include_once('./system/load.loadCheck.php');
/**
 * fix user data, load config, enable class auto loader
 */
include_once('./system/load.init.php');
/**
 * DATABASE
 */
include_once('./system/load.database.php');
if (DEBUG_DATABASE) {
	Website::getDBHandle()->setPrintQueries(true);
}
/**
 * EndDatabase
 */

$payee = new PayPal\Api\Payee();
if ($config['paypal']['env'] == "production") {
	$payee->setEmail($config['paypal']['email']);
} else {
	$payee->setEmail(onfig['paypal']['sandboxemail']);
}


$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$product_id = $_REQUEST['product_id'];
if (isset($_SESSION['pid'])) {
	$product_id = $_SESSION['pid'];
}
//$accname = "ai";
if (isset($_SESSION['account'])) {
	$accname = $_SESSION['account'];
} else {
	exit();
}

$price = (array_keys($config['donate']['offers'][intval($product_id)])[0] / 100);
$qnt = array_values($config['donate']['offers'][intval($product_id)])[0];

$item = new \PayPal\Api\Item();
$item->setName($config['paypal']['itemName'])
	->setCurrency($config['paypal']['currency'])
	->setDescription("{$qnt} - {$config['paypal']['itemName']}")
	->setQuantity(1)
	->setPrice($price)
	->setSku($accname . '-' . $product_id);

$list = new \PayPal\Api\ItemList();
$list->setItems([$item]);

//$subtotal = (number_format($price/$qnt,2))*$qnt;
//$shipping_discount = $price - ((number_format($price/$qnt,2))*$qnt);
$details = new \PayPal\Api\Details();
$details->setShipping(0)
	->setTax(0)
	->setShippingDiscount(0)
	->setSubtotal($price);

$amount = new \PayPal\Api\Amount();
$amount->setTotal($price)
	->setCurrency('BRL')
	->setDetails($details);

$notify_url = $config['paypal']['notify_url'];
$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount)
	->setItemList($list)
	->setDescription("Compra de {$qnt} {$config["paypal"]["itemName"]}.")
	->setNotifyUrl($notify_url);


$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl($config['base_url'])
	->setCancelUrl($config['base_url']);

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
	->setPayer($payer)
	->setTransactions(array($transaction))
	->setRedirectUrls($redirectUrls);
// 4. Make a Create Call and print the values
try {
	$payment->create($apiContext);
	echo $payment;
} catch (\PayPal\Exception\PayPalConnectionException $ex) {
	// This will print the detailed information on the exception.
	//REALLY HELPFUL FOR DEBUGGING
	echo $ex->getMessage();
}
