<?php

/**
	* PAGSEGURO WORKING
	* FIXED BY RICARDO SOUZA
	* http://codenome.com
*/
require_once 'config/config.php';
require_once "vendor/autoload.php";
require_once "pagseguro_config.php";

if ($config['pagseguro']['testing'] == true) {
	header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
} else {
	header("access-control-allow-origin: https://pagseguro.uol.com.br");
}

// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);

define('INITIALIZED', true);

// if not defined before, set 'false' to load all normal
if (!defined('ONLY_PAGE'))
	define('ONLY_PAGE', false);

// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');

// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');

// DATABASE
include_once('./system/load.database.php');
if (DEBUG_DATABASE)
	Website::getDBHandle()->setPrintQueries(true);
// DATABASE END

$method = $_SERVER['REQUEST_METHOD'];

if ('POST' == $method) {

	$type = $_POST['notificationType'];
	$notificationCode = $_POST['notificationCode'];

	if ($type === 'transaction') {

		try {
			\PagSeguro\Library::initialize();
			\PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
			\PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

			if (\PagSeguro\Helpers\Xhr::hasPost()) {
				/** @var \PagSeguro\Parsers\Transaction\Response $transaction */
				$transaction = \PagSeguro\Services\Transactions\Notification::check(
					/** @var \PagSeguro\Domains\AccountCredentials | \PagSeguro\Domains\ApplicationCredentials $credentials */
					\PagSeguro\Configuration\Configure::getAccountCredentials()
				);
			} else {
				throw new \InvalidArgumentException($_POST);
			}

			$reference = explode("-", $transaction->getReference());
			$transaction_code = $transaction->getCode();
			$verify_transaction = function () use ($SQL, $transaction_code) {
				$v = $SQL->prepare("SELECT * FROM pagseguro_transactions where transaction_code = :tcode AND status = 'DELIVERED'");
				$v->execute(['tcode' => $transaction_code]);
				if ($v->rowCount() == 0) {
					return true;
				} else {
					return false;
				}
			};
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

			//            $credentials = PagSeguroConfig::getAccountCredentials();
			//            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $notificationCode);


			$arrayPDO['transaction_code'] = $transaction->getCode();
			$email = $transaction->getSender();

			$name = $reference[0]; //exploded from reference;
			$arrayPDO['name'] = $name;
			$product_id = $reference[1];
			$price = (array_keys($config['donate']['offers'][intval($product_id)])[0] / 100);
			$coinCount = array_values($config['donate']['offers'][intval($product_id)])[0];
			$arrayPDO['item_count'] = $coinCount;
			//            $arrayPDO['payment_method'] = $transaction->getPaymentMethod()->getType()->getTypeFromValue();
			$arrayPDO['payment_method'] = $transaction->getPaymentMethod()->getType();
			//            $arrayPDO['status'] = $transaction->getStatus()->getTypeFromValue();
			$arrayPDO['status'] = $transaction->getStatus();

			$arrayPDO['payment_amount'] = $transaction->getGrossAmount();
			$item = $transaction->getItems();

			$date_now = date('Y-m-d H:i:s');
			$arrayPDO['data'] = $date_now;

			if ($verify_transaction()) {
				if ($arrayPDO['status'] == 3) {
					$arrayPDO['status'] = "pago";
					try {
						$conn = $SQLPDO;
						$stmt = $conn->prepare('INSERT into pagseguro_transactions SET transaction_code = :transaction_code, name = :name, payment_method = :payment_method, status = :status, item_count = :item_count, data = :data, payment_amount = :payment_amount');
						//                $stmt = $conn->prepare('INSERT INTO `pagseguro_transactions`(`transaction_code`,`name`,`payment_method`,`status`,`item_count`,`data`,`payment_amount`)VALUES(:transaction_code,:name,:payment_method,:status,:item_count,:data,:payment_amount);');
						$stmt->execute($arrayPDO);

						$arrayPDO['item_count'] = ($doubleStatus() ? ($arrayPDO['item_count'] * 2) : $arrayPDO['item_count']);

						$stmt = $conn->prepare('UPDATE accounts SET coins = coins + :item_count WHERE name = :name');
						$stmt->execute(array('item_count' => $arrayPDO['item_count'], 'name' => $arrayPDO['name']));

						//                        $now = time();
						//                        $stmt = $conn->prepare("INSERT INTO z_shop_donates (date, reference, account_name, method, price, points, status) VALUES (:date, :reference, :account_name, :method, :price, :points, :status)");
						//                        $stmt->execute(['date' => $now, 'reference' => $transaction->getReference(), 'account_name' => $name, 'method' => $transaction->getPaymentMethod()->getType()->getTypeFromValue(), 'price' => ($price / 100), 'points' => $coinCount, 'status' => 'delivered']);

						$stmt = $conn->prepare("UPDATE pagseguro_transactions SET status = 'DELIVERED' WHERE transaction_code = :transaction_code AND status = 'pago'");
						$stmt->execute(array('transaction_code' => $arrayPDO['transaction_code']));
					} catch (PDOException $e) {
						die('ERROR: ' . $e->getMessage());
					}
					$pay_method = "Pagseguro";
					$acc = new Account();
					$acc->loadByName(strtolower($name));
					include_once "send_payment_voucher.php";
					echo 'wow';
				}
			} else {
				die("ERROR: Pagamento j? processado.");
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
