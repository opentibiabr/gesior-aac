<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 24/03/2018
 * Time: 23:47
 */

require 'config.php';

use PayPal\Api\Payment;

try {
	$params = array('count' => 10, 'start_index' => 5);

	$payments = Payment::all($params, $apiContext);
} catch (Exception $ex) {
	exit(1);
}
