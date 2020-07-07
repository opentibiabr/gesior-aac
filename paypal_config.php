<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 24/03/2018
 * Time: 20:34
 */

require_once "config/config.php";
require_once "vendor/autoload.php";

$apiContext = '';
if ($config['paypal']['env'] == "production") {
	$apiContext = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
			$config['paypal']['clientID'], //ClientID
			$config['paypal']['clientSecretID'] //ClientSecretID
		)
	);
	$apiContext->setConfig(["mode" => "live"]);
} elseif ($config['paypal']['env'] == "sandbox") {
	$apiContext = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
			$config['paypal']['sandboxClientID'],     // ClientID
			$config['paypal']['sandboxClientSecretID']      // ClientSecret
		)
	);
	$apiContext->setConfig(
		[
			'log.LogEnabled' => true,
			'log.FileName' => 'paypal.log',
			'log.LogLevel' => 'DEBUG'
		]
	);
} else {
	exit(1);
}
