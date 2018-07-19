<?php
if(!defined('INITIALIZED'))
	exit;
header("access-control-allow-origin: https://".(($config['pagseguro']['testing'] === true) ? 'sandbox.' : '')."pagseguro.uol.com.br");
if(isset($_POST['notificationType'])) {
	
	$notificationCode = $_POST['notificationCode'];
	$url = 'https://ws'.(($config['pagseguro']['testing'] === true) ? '.sandbox' : '').'.pagseguro.uol.com.br/v2/transactions/notifications/'.$notificationCode.'/?email='.$config['pagseguro']['email'].'&token='.(($config['pagseguro']['testing'] === true) ? $config['pagseguro']['tokentest'] : $config['pagseguro']['token']);
	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$executeCurl = curl_exec($curl);
	curl_close($curl);
	
	$transaction = simplexml_load_string($executeCurl);
	
	$explodeRef = explode("-",$transaction->reference);
	$ref = $explodeRef[0];
	$acc_name = htmlspecialchars($explodeRef[1]);
	$accInfo = new Account();
	$accInfo->loadByName($acc_name);
	
	$getServiceID = $SQL->query("SELECT `service_id` FROM `z_shop_payment` WHERE `ref` = '$ref'")->fetch();
	$getPointsQtd = $SQL->query("SELECT `coins` FROM `z_shop_donates` WHERE `reference` = '$ref' AND `account_name` = '$acc_name'")->fetch();
	
	$doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
	
	if($doubleStatus['value'] == "active")
		$points_bought = 2 * $getPointsQtd['coins'];
	else	
		$points_bought = $getPointsQtd['coins'];
	
	$loyaltyPoints = $getPointsQtd['coins'];
		
	$getPayment = $SQL->query("SELECT COUNT(*) AS count FROM `pagseguro` WHERE `reference` = '".$transaction->reference."'")->fetch();
	
	if($getPayment['count'] > 0)
		$update = $SQL->query("UPDATE `pagseguro` SET `status` = '".$transaction->status."' WHERE `code` = '".$transaction->code."' LIMIT 1");
	else	
		$add = $SQL->query("INSERT INTO `pagseguro` SET `date` = '".$transaction->date."', `code` = '".$transaction->code."', `reference` = '".$transaction->reference."', `type` = '".$transaction->type."', `status` = '".$transaction->status."', `lastEventDate` = '".$transaction->lastEventDate."'");
	
	if ($transaction->status == 3) {
		$accInfo->setPremiumPoints($accInfo->getPremiumPoints() + $points_bought);
		$accInfo->setLoyalty($accInfo->getLoyalty() + $loyaltyPoints);
		$accInfo->save();
		$update_payment = $SQL->query("UPDATE `z_shop_donates` SET `status` = 'received' WHERE `reference` = '$ref' AND `account_name` = '$acc_name'");
	} elseif ($transaction->status == 7) {
		$update_payment = $SQL->query("UPDATE `z_shop_donates` SET `status` = 'canceled' WHERE `reference` = '$ref' AND `account_name` = '$acc_name'");
	}
	
	
} else
	header("Location: ./?subtopic=accountmanagement&action=manage");