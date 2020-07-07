<?php

/* Simple integration with PicPay
	* Notification file
	* @author: World Script
* /


/ * This file must be configured in your callback url
	* for PicPay I can send requests here.
	* Picpay will expect an HTTP 200 response from your site
	* Access the PicPay documentation to see more details.
	* https://ecommerce.picpay.com/doc/
*/

require 'config/config.php';

// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);
define('INITIALIZED', true);

if (!defined('ONLY_PAGE'))
	define('ONLY_PAGE', true);

$navegador = filter_input(INPUT_SERVER, "HTTP_USER_AGENT", FILTER_DEFAULT);
if ($navegador !== "Mozilla/5.0") {
  header("Location: ./?subtopic=accountmanagement");
}

// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');

// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');

// DATABASE
include_once('./system/load.database.php');
if (DEBUG_DATABASE)
	Website::getDBHandle()->setPrintQueries(true);

  $picpay = new PicPay;
  /*
- "created": registro criado
- "expired": prazo para pagamento expirado
- "analysis": pago e em processo de análise anti-fraude
- "paid": pago
- "completed": pago e saldo disponível
- "refunded": pago e devolvido
- "chargeback": pago e com chargeback
  */

	// função que verifica a requisição
	$notification = $picpay->notificationPayment();

	if($notification){

		$status = $notification->status;
		$authorizationId = $notification->authorizationId;
		$referenceId = $notification->referenceId;
		$picpayPayment = new PicPayPayment();
		$picpayPayment->loadById((int) $referenceId);
		if ($picpayPayment->isLoaded()) {
			$picpayPayment->setAuthorizationid($authorizationId);
			$picpayPayment->setStatus($status);
			$picpayPayment->save();
			if ($status == "completed") {
				$doubleStatus = function () use ($SQL) {
					$q = $SQL->prepare("SELECT value FROM server_config WHERE config = 'double'");
					$q->execute([]);
					$q = $q->fetchAll();
					if ($q[0]['value'] == "active") {
						return true;
					} else {
						return false;
					}
				};
				$verify_transaction = function () use ($SQL, $id) {
					$v = $SQL->prepare("SELECT * FROM picpay_payment where id = :id AND status = 'DELIVERED'");
					$v->execute(['id' => $id]);
					if ($v->rowCount() == 0) {
						return true;
					} else {
						return false;
					}
				};

				if ($verify_transaction()) {
					try {
					$conn = $SQLPDO;
					$entregarCoins = ($doubleStatus() ? ($picpayPayment->getCoins() * 2) : $picpayPayment->getCoins());

					$stmt = $conn->prepare('UPDATE accounts SET coins = coins + :item_count WHERE id = :id');
					$stmt->execute(array('item_count' => $entregarCoins, 'id' => $picpayPayment->getAccount() ));
					$stmt = $conn->prepare("UPDATE picpay_payment SET status = 'DELIVERED' WHERE id = :id");
					$stmt->execute(array('id' => $picpayPayment->getID()));
					} catch (PDOException $e) {
						die('ERROR: ' . $e->getMessage());
					}
						$pay_method = "PicPay";
						$acc = new Account();
						$acc->loadByName(strtolower($name));
						include_once "send_payment_voucher.php";
						echo 'wow';
					}
				}


			}
		}
	}

	?>