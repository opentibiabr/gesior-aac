<?php
require __DIR__ . '/vendor/autoload.php';

require_once 'config/config.php';

define('INITIALIZED', true);
if (!defined('ONLY_PAGE'))
	define('ONLY_PAGE', false);
include_once "system/load.init.php";
include_once "system/load.login.php";
include_once "system/load.database.php";
include_once "system/load.compat.php";

header('');
$hue = [];
/**
 * @param String $msg
 */
function sendErrorMsg($msg = null)
{
	$hue['status'] = "error";
	if ($msg !== null) {
		$hue['msg'] = $msg;
	} else {
		$hue['msg'] = "Somente requisições post são permitidas.";
	}
	echo json_encode($hue);
}
if (isset($_POST)) {
	if (isset($_POST['SecretCode'])) {
		$code = $_POST['SecretCode'];
		$secret = $account_logged->getSecret();
		$result = $tfa->verifyCode($secret, $code);

		if ($result === true) {
			$hue['status'] = 'success';
			$_SESSION['SecretCode'] = $_POST['SecretCode'];
			$account_logged->setSecretStatus(true);
			$account_logged->save();
			echo json_encode($hue);
		} else {
			sendErrorMsg('Secret Code inválido.');
		}
	} elseif (isset($_POST['inactivate'])) {
		$status = $account_logged->getSecretStatus();
		if ($status == 1) {
			$hue['status'] = 'success';
			$account_logged->setSecretStatus(false);
			$account_logged->save();
			echo json_encode($hue);
		} else {
			sendErrorMsg('always inactive');
		}
	} else {
		sendErrorMsg('Dados post inválidos.');
	}
} else {
	sendErrorMsg();
}
