<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 27/03/2018
 * Time: 19:46
 */

// Include Mercadopago library
require_once "config/config.php";
require_once "vendor/autoload.php";

// Create an instance with your MercadoPago credentials (CLIENT_ID and CLIENT_SECRET):
// Argentina: https://www.mercadopago.com/mla/herramientas/aplicaciones
// Brasil: https://www.mercadopago.com/mlb/ferramentas/aplicacoes
// Mexico: https://www.mercadopago.com/mlm/herramientas/aplicaciones
// Venezuela: https://www.mercadopago.com/mlv/herramientas/aplicaciones
// Colombia: https://www.mercadopago.com/mco/herramientas/aplicaciones
// Chile: https://www.mercadopago.com/mlc/herramientas/aplicaciones
try {
	$now = date('[d-m-Y H:i:s]');
	if ($config['mp']['sandboxMode']) {
		$mp = new MP($config['mp']['SANDBOX_CLIENT_ID'], $config['mp']['SANDBOX_CLIENT_SECRET']);
	} else {
		$mp = new MP($config['mp']['CLIENT_ID'], $config['mp']['CLIENT_SECRET']);
	}
	$mp->sandbox_mode($config['mp']['sandboxMode']);

	// Check mandatory parameters
	//    if (!isset($_GET["id"], $_GET["topic"]) || !ctype_digit($_GET["data_id"])) {
	//        $handle = fopen('mp.log', 'a');
	//        fwrite($handle, "------------------------\r\n");
	//        foreach ($_REQUEST as $key => $value){
	//            fwrite($handle, $now." {$key} => {$value} \r\n");
	//        }
	//        fwrite($handle, $now." ERROR 400 \r\n");
	//        fwrite($handle, "------------------------\r\n");
	//        http_response_code(400);
	//        return;
	//    }
	if (isset($_REQUEST['type'])) {
		$topic = $_REQUEST['type'];
		$id = $_REQUEST['data_id'];
	} else {
		$topic = $_GET["topic"];
		$id = $_REQUEST['id'];
	}
	$merchant_order_info = NULL;

	switch ($topic) {
		case 'payment':
			$payment_info = $mp->get("/v1/payments/" . $id);
			$merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["order"]["id"]);
			break;
		case 'merchant_order':
			$merchant_order_info = $mp->get("/merchant_orders/" . $id);
			break;
		default:
			$merchant_order_info = NULL;
	}

	if ($merchant_order_info == NULL) {
		echo "Error obtaining the merchant_order";
		die();
	}
	if ($merchant_order_info["status"] == 200) {
		$handle = fopen('mp.log', 'a');
		fwrite($handle, "------------------------\r\n");
		foreach ($_REQUEST as $key => $value) {
			fwrite($handle, $now . " Status 200 {$key} => {$value} \r\n");
		}
		fwrite($handle, "------------------------\r\n");
	}
} catch (MercadoPagoException $e) {
	$handle = fopen('mp.log', 'a');
	fwrite($handle, "------------------------\r\n");
	foreach ($_REQUEST as $key => $value) {
		fwrite($handle, $now . " {$key} => {$value} \r\n");
	}
	fwrite($handle, $now . " ERROR: {$e->getMessage()} \r\n");
	fwrite($handle, "------------------------\r\n");
}
