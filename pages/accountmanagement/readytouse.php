<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:21
 */

$paymentId = (int) $_REQUEST['serviceID'];
$getPaymentInfo = $SQL->query("SELECT * FROM `z_shop_payment` WHERE `id` = '$paymentId' AND `account_name` = '" . $account_logged->getName() . "'")->fetch();
$character_id = (int) $_REQUEST['character'];
$newcharName = (string) trim($_REQUEST['newcharname']);
$newaccountname = (string) trim($_REQUEST['newaccountname']);
$getItemInfo = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `id` = '" . $getPaymentInfo['service_id'] . "'")->fetch();

if ($getPaymentInfo['status'] != "ready")
	if ($_REQUEST['active_service'] == "yes")
		$ready_errors[] = "You have no service to activate right now.";

if (empty($ready_errors))
	if ($newaccountname == "")
		if ($_REQUEST['active_service'] == "yes" && $getItemInfo['id'] == 7)
			$ready_errors[] = "Please enter the new name of your account.";
if (empty($ready_errors))
	if ($_REQUEST['active_service'] == "yes" && $getItemInfo['id'] == 7) {
		if (strlen($newaccountname) < 3)
			$ready_errors[] = 'This account name is too short!';
		elseif (strlen($newaccountname) > 10)
			$ready_errors[] = 'This account name is too long!';
		else
			$newaccountname = strtoupper($newaccountname);
	}
if (empty($ready_errors))
	if ($_REQUEST['active_service'] == "yes" && $getItemInfo['id'] == 7)
		if (!ctype_alnum($newaccountname))
			$ready_errors[] = 'This account name has an invalid format. Your account name may only consist of numbers 0-9 and letters A-Z!';
		elseif (!preg_match('/[A-Z0-9]/', $newaccountname))
			$ready_errors[] = 'Your account name must include at least one letter A-Z!';
		else {
			$acc = new Account($newaccountname, Account::LOADTYPE_NAME);
			if ($acc->isLoaded())
				$ready_errors[] = 'This account name is already used. Please select another one!';
		}
if ($character_id == "")
	if ($_REQUEST['active_service'] == "yes" && $getItemInfo['id'] <= 6)
		$ready_errors[] = "You do not have characters that account.";
if (empty($ready_errors)) {
	if ($_REQUEST['active_service'] == "yes" && $getItemInfo['id'] <= 6) {
		$player = new Player();
		$player->loadById($character_id);
		if (!$player->isLoaded())
			$ready_errors[] = "Informed character does not exist.";
	}
}
if (empty($ready_errors))
	if ($_REQUEST['active_service'] == "yes")
		if ($getPaymentInfo['service_category_id'] == 2 && $getItemInfo['offer_type'] == "changename") {
			$new_name = new Player();
			$new_name->loadByName($newcharName);
			if ($new_name->isLoaded())
				$ready_errors[] = "<strong>" . $newcharName . "</strong> has already been used on another character, please choose another name.";
		}

if (empty($ready_errors))
	if ($_REQUEST['active_service'] == "yes")
		if ($getPaymentInfo['service_category_id'] == 2 && $getItemInfo['offer_type'] == "changename")
			if (!check_name_new_char($newcharName) || empty($newcharName))
				$ready_errors[] = "Please type a valid name for your character.";
if (empty($ready_errors))
	if ($_REQUEST['active_service'] == "yes")
		if ($getPaymentInfo['service_category_id'] == 2 && $getItemInfo['offer_type'] == "changename")
			if (!ctype_upper($newcharName[0]))
				$ready_errors[] = 'The first letter of a name has to be a capital letter!';
if (empty($ready_errors))
	if ($_REQUEST['active_service'] == "yes")
		if ($getPaymentInfo['service_category_id'] == 2 && $getItemInfo['offer_type'] == "changename") {
			foreach (explode(' ', $newcharName) as $k => $v) {
				$words[$k] = str_split($v);
				$len = strlen($v);
				if ($len == 1) {
					$ready_errors[] = 'This name contains a word with only one letter. Please use more than one letter for each word!';
					break;
				} elseif ($len > 14) {
					$ready_errors[] = 'This name contains a word that is too long. Please use no more than 14 letters for each word!';
					break;
				}
			}
		}
if (empty($ready_errors))
	if ($_REQUEST['active_service'] == "yes")
		if ($getPaymentInfo['service_category_id'] == 2 && $getItemInfo['offer_type'] == "changename") {
			$total = 0;
			foreach ($words as $k => $p) {
				if (isset($ready_errors))
					break;
				$total++;
				if ($total > 3) {
					$ready_errors[] = 'This name contains more than 3 words. Please choose another name!';
					break;
				}
				$len = 0;
				foreach ($p as $i => $j) {
					$len++;
					if ($i != 0 && ctype_upper($j)) {
						$ready_errors[] = 'In names capital letters are only allowed at the beginning of a word!';
						break;
					} elseif ($i == $len - 1) {
						$ff = NULL;
						for ($h = 0; $h < strlen($v); $h++) {
							if (in_array(strtolower($v[$h]), array('a', 'e', 'i', 'o', 'u')) !== false) {
								$ff = TRUE;
								break;
							}
						}
						if (!$ff) {
							$ready_errors[] = 'This name contains a word without vowels. Please choose another name!';
							break;
						}
					}
				}
			}
		}
if (!empty($ready_errors)) {
	$main_content .= '
							<div class="TableContainer" >
								<table class="Table1" cellpadding="0" cellspacing="0" >
									<div class="CaptionContainer" >
										<div class="CaptionInnerContainer" >
											<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<div class="Text" >Services Page Errors</div>
											<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										</div>
									</div>
									<tr>
										<td>
											<div class="InnerTableContainer" >
												<table style="width:100%;" >
													<tr>
														<td>';
	foreach ($ready_errors as $error)
		$main_content .= $error . '<br>';
	$main_content .= '
														</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
								</table>
							</div><BR>
							<TABLE BORDER=0 WIDTH=100%>
								<TR>
									<TD ALIGN=center>
										<table border="0" cellspacing="0" cellpadding="0" >
											<form action="?subtopic=accountmanagement&action=readytouse" method="post">
												<input type="hidden" name="serviceID" value="' . $_REQUEST['serviceID'] . '">
												<tr>
													<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
															</div>
														</div>
													</td>
												</tr>
											</form>
										</table>
									</TD>
								</TR>
							</TABLE>';
} else {
	if ($_REQUEST['active_service'] == "yes") {

		$serviceInfo = (int) $_REQUEST['serviceInfo'];
		$getItemId = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `id` = '$serviceInfo'")->fetch();
		$serviceID = (int) $_REQUEST['serviceID'];
		$player_id = (int) $_REQUEST['character'];
		$newcharName = (string) trim($_REQUEST['newcharname']);
		$player = new Player();
		$player->loadById($player_id);
		if ($player->isLoaded())
			$player_name = addslashes($player->getName());
		if ($getItemId['category'] >= 3) {
			if ($getItemId['category'] == 5) {
				$add_service = $SQL->query("INSERT INTO `z_ots_comunication` (`name`, `type`, `action`, `param1`, `param2`, `param3`, `param4`, `param5`, `param6`, `param7`, `delete_it`) VALUES ('$player_name', 'login', 'give_item', '" . $getItemId['itemid'] . "', '" . $getItemId['count'] . "', '', '', 'item', '" . addslashes($getItemId['offer_name']) . "', '" . $getItemId['id'] . "', '1')");

				if ($add_service)
					$update_payment = $SQL->query("UPDATE `z_shop_payment` SET `status` = 'received' WHERE `id` = '$serviceID' AND `account_name` = '" . $account_logged->getName() . "'");
				else
					$main_content .= 'There was an error , contact the administrator to resolve.';
			}

			if ($getItemId['category'] == 4) {
				$add_service = $SQL->query("INSERT INTO `z_ots_comunication` (`name`, `type`, `action`, `param1`, `param2`, `param3`, `param4`, `param5`, `param6`, `param7`, `delete_it`) VALUES ('$player_name', 'login', 'give_outfit', '', '', '" . $getItemId['addon_name'] . "', '', 'outfit', '" . addslashes($getItemId['offer_name']) . "', '" . $getItemId['id'] . "', '1')");

				if ($add_service)
					$update_payment = $SQL->query("UPDATE `z_shop_payment` SET `status` = 'received' WHERE `id` = '$serviceID' AND `account_name` = '" . $account_logged->getName() . "'");
				else
					$main_content .= 'There was an error , contact the administrator to resolve.';
			}

			if ($getItemId['category'] == 3) {
				$add_service = $SQL->query("INSERT INTO `z_ots_comunication` (`name`, `type`, `action`, `param1`, `param2`, `param3`, `param4`, `param5`, `param6`, `param7`, `delete_it`) VALUES ('$player_name', 'login', 'give_mount', '', '', '', '" . $getItemId['mount_id'] . "', 'mount', '" . addslashes($getItemId['offer_name']) . "', '" . $getItemId['id'] . "', '1')");

				if ($add_service)
					$update_payment = $SQL->query("UPDATE `z_shop_payment` SET `status` = 'received' WHERE `id` = '$serviceID' AND `account_name` = '" . $account_logged->getName() . "'");
				else
					$main_content .= 'There was an error , contact the administrator to resolve.';
			}

			$main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
										<div class="Text" >Services Actived</div>
										<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
										<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
										<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									</div>
								</div>
								<tr>
									<td>
										<div class="InnerTableContainer" >
											<table style="width:100%;" >
												<tr>
													<td>Your ' . $getItemId['offer_name'] . ' is active in your character ' . $player->getName() . '. Just log into your character and you receive it in the game.</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
							</table>
						</div><BR>
						<TABLE BORDER=0 WIDTH=100%>
							<TR>
								<TD ALIGN=center>
									<table border="0" cellspacing="0" cellpadding="0" >
										<form action="?subtopic=accountmanagement&action=manage" method="post">
											<tr>
												<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
														<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
															<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
														</div>
													</div>
												</td>
											</tr>
										</form>
									</table>
								</TD>
							</TR>
						</TABLE>';
		}
		if ($getItemId['category'] == 2) {
			if ($getItemId['offer_type'] == "changename") {
				$datetoHide = time() + ($config['site']['formerNames'] * 86400);
				$record_old_name = $SQL->query("INSERT INTO `player_former_names` (`player_id`,`former_name`,`date`) VALUES ('" . $player->getID() . "','" . $player->getName() . "','" . $datetoHide . "')");
				if ($record_old_name) {
					$player->setName($newcharName);
					$player->save();
					$update_payment = $SQL->query("UPDATE `z_shop_payment` SET `status` = 'received' WHERE `id` = '$serviceID' AND `account_name` = '" . $account_logged->getName() . "'");
				}

				$main_content .= '
							<div class="TableContainer" >
								<table class="Table1" cellpadding="0" cellspacing="0" >
									<div class="CaptionContainer" >
										<div class="CaptionInnerContainer" >
											<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<div class="Text" >Services Actived</div>
											<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										</div>
									</div>
									<tr>
										<td>
											<div class="InnerTableContainer" >
												<table style="width:100%;" >
													<tr>
														<td>You have successfully changed the name of your character. The new name is ' . $newcharName . '</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
								</table>
							</div><BR>
							<TABLE BORDER=0 WIDTH=100%>
								<TR>
									<TD ALIGN=center>
										<table border="0" cellspacing="0" cellpadding="0" >
											<form action="?subtopic=accountmanagement&action=manage" method="post">
												<tr>
													<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
															</div>
														</div>
													</td>
												</tr>
											</form>
										</table>
									</TD>
								</TR>
							</TABLE>';
			}
			if ($getItemId['offer_type'] == "changesex") {
				$add_service = $SQL->query("INSERT INTO `z_ots_comunication` (`name`, `type`, `action`, `param1`, `param2`, `param3`, `param4`, `param5`, `param6`, `param7`, `delete_it`) VALUES ('$player_name', 'login', 'change_sex', '', '', '', '', 'sex', '" . $getItemId['offer_name'] . "', '" . $player->getSex() . "', '1')");
				//$update_payment = $SQL->query("UPDATE `z_shop_payment` SET `status` = 'received' WHERE `id` = '$serviceID'");

				$main_content .= '
							<div class="TableContainer" >
								<table class="Table1" cellpadding="0" cellspacing="0" >
									<div class="CaptionContainer" >
										<div class="CaptionInnerContainer" >
											<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<div class="Text" >Services Actived</div>
											<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										</div>
									</div>
									<tr>
										<td>
											<div class="InnerTableContainer" >
												<table style="width:100%;" >
													<tr>
														<td>You character\'s gender was changed successfully.</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
								</table>
							</div><BR>
							<TABLE BORDER=0 WIDTH=100%>
								<TR>
									<TD ALIGN=center>
										<table border="0" cellspacing="0" cellpadding="0" >
											<form action="?subtopic=accountmanagement&action=manage" method="post">
												<tr>
													<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
															</div>
														</div>
													</td>
												</tr>
											</form>
										</table>
									</TD>
								</TR>
							</TABLE>';
			}
			if ($getItemId['offer_type'] == "newrk") {
				//Function to generate NUMBERS
				function generateRK($length)
				{
					$vowels = "AEIOU";
					$consonants = "BDGHJLMNPQRSTVWXYZ0123456789";
					$password = "";
					$alt = time() % 2;
					for ($i = 0; $i < $length; $i++) {
						if ($alt == 1) {
							$password .= $consonants[(rand() % strlen($consonants))];
							$alt = 0;
						} else {
							$password .= $vowels[(rand() % strlen($vowels))];
							$alt = 1;
						}
					}
					return $password;
				}

				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$hash = md5(implode($_POST));
					if (isset($_SESSION['hash']) && $_SESSION['hash'] == $hash) {
						header("Location: ?subtopic=accountmanagement&action=manage");
					} else {
						$_SESSION['hash'] = $request;
						$recoveryKey = generateRk(4) . '-' . generateRk(4) . '-' . generateRk(4) . '-' . generateRk(4);
						$newRk = $account_logged;
						$newRk->setKey($recoveryKey);
						$newRk->save();
						$update_payment = $SQL->query("UPDATE `z_shop_payment` SET `status` = 'received' WHERE `id` = '$serviceID' AND `account_name` = '" . $account_logged->getName() . "'");
					}
				}

				if ($newRk)
					$main_content .= '
								<div class="TableContainer" >
									<table class="Table1" cellpadding="0" cellspacing="0" >
										<div class="CaptionContainer" >
											<div class="CaptionInnerContainer" >
												<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
												<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
												<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
												<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
												<div class="Text" >New Recovery Key</div>
												<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
												<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
												<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
												<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											</div>
										</div>
										<tr>
											<td>
												<div class="InnerTableContainer" >
													<table style="width:100%;" >
														Thank you for your purchase, below is your new recovery key that can be used to recover your account if lost.<br/>
														<br/>
														<font size="5">&nbsp;&nbsp;&nbsp;<b>Recovery Key: ' . $account_logged->getKey() . '</b></font><br/>
														<br/>
														<br/>
														<b>Important:</b>
														<ul>
															<li>Write down this recovery key carefully.</li>
															<li>Store it at a safe place! Do not save it on your computer!</li>
															<li>You will not receive an email containing this recovery key.</li>
															<li>If you lose will have to buy another again by our Shop.</li>
														</ul>
													</table>
												</div>
											</table>
										</div>
									</td>
								</tr>
								<br/>
								<center>
									<table border="0" cellspacing="0" cellpadding="0" >
										<form action="?subtopic=accountmanagement" method="post" >
											<tr>
												<td style="border:0px;" ><input type="hidden" name=action value=manage >
													<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
														<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
															<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
														</div>
													</div>
												</td>
											</tr>
										</form>
									</table>
								</center>';
			}
			if ($getItemId['offer_type'] == "changeaccountname") {
				$updateOrderNewAccount = $SQL->query("UPDATE `z_shop_payment` SET `account_name` = '$newaccountname' WHERE `account_name` = '" . $account_logged->getName() . "'");
				$account = $account_logged;
				$account->setName($newaccountname);
				$account->save();
				$update_payment = $SQL->query("UPDATE `z_shop_payment` SET `status` = 'received' WHERE `id` = '$serviceID' AND `account_name` = '" . $account_logged->getName() . "'");
				$main_content .= '
							<div class="TableContainer" >
								<table class="Table1" cellpadding="0" cellspacing="0" >
									<div class="CaptionContainer" >
										<div class="CaptionInnerContainer" >
											<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<div class="Text" >Services Actived</div>
											<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										</div>
									</div>
									<tr>
										<td>
											<div class="InnerTableContainer" >
												<table style="width:100%;" >
													<tr>
														<td>You have changed the name of your account successfully. The new name is ' . $newaccountname . '.</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
								</table>
							</div><BR>
							<TABLE BORDER=0 WIDTH=100%>
								<TR>
									<TD ALIGN=center>
										<table border="0" cellspacing="0" cellpadding="0" >
											<form action="?subtopic=accountmanagement&action=manage" method="post">
												<tr>
													<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
															<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
															</div>
														</div>
													</td>
												</tr>
											</form>
										</table>
									</TD>
								</TR>
							</TABLE>';
			}
		}
	} else {
		$getServiceInfo = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `id` = '" . $getPaymentInfo['service_id'] . "'")->fetch();
		$main_content .= '
				<form method="post" action="?subtopic=accountmanagement&action=readytouse">
					<div class="TableContainer" >
						<table class="Table3" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" >
									<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Service Details</div>
									<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>If necessary choose a character for which you want to activate the service and then click "Submit".</td>
											</tr>
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td class="LabelV150" >Date of purchase:</td>
																	<td>' . date("M d Y", $getPaymentInfo['date']) . '</td>
																</tr>
																<tr>
																	<td class="LabelV150" >Service:</td>
																	<td>' . $getServiceInfo['offer_name'] . '</td>
																</tr>
															</table>
														</div>
													</div>
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>';
		if ($getServiceInfo['category'] >= "3") {
			$main_content .= '
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td width="32px">';
			if ($getServiceInfo['category'] == "5")
				$main_content .= '
																		<img src="./' . $layout_name . '/images/shop/items/' . $getServiceInfo['itemid'] . '.gif">';
			if ($getServiceInfo['category'] == "4")
				$main_content .= '<img src="./' . $layout_name . '/images/shop/outfits/' . strtolower($getServiceInfo['addon_name']) . '_male.gif">';
			if ($getServiceInfo['category'] == "3")
				$main_content .= '<img src="./' . $layout_name . '/images/shop/mounts/' . str_replace(" ", "_", $getServiceInfo['offer_name']) . '.gif">';
			$main_content .= '
																	</td>
																	<td>
																		Select the character to receive service:
																		<select name="character">';
			$account_players = $account_logged->getPlayersList();
			foreach ($account_players as $player)
				$main_content .= '
																			<option value="' . $player->getID() . '">' . $player->getName() . '</option>';
			$main_content .= '
																		</select>
																	</td>
																</tr>
															</table>
														</div>
													</div>
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>';
		} else {
			if ($getServiceInfo['offer_type'] == "changename") {
				$main_content .= '
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
																<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																	<tr>
																		<td class="LabelV150">New Character name:</td>
																		<td><input type="text" name="newcharname" size="30"></td>
																		<td>
																			to:
																			<select name="character">';
				$account_players = $account_logged->getPlayersList();
				foreach ($account_players as $player)
					$main_content .= '
																				<option value="' . $player->getID() . '">' . $player->getName() . '</option>';
				$main_content .= '
																			</select>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="3">To change your character\'s name, <strong>it must be offline</strong>.</td>
																	</tr>
																</table>
															</div>
														</div>
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>';
			}
			if ($getServiceInfo['offer_type'] == "changesex") {
				$main_content .= '
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
																<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																	<tr>
																		<td class="LabelV150">Change the gender of:</td>
																		<td>
																			to:
																			<select name="character">';
				$account_players = $account_logged->getPlayersList();
				foreach ($account_players as $player)
					$main_content .= '
																				<option value="' . $player->getID() . '">' . $player->getName() . '</option>';
				$main_content .= '
																			</select>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2">To change your character\'s gender, <strong>it must be offline</strong>.</td>
																	</tr>
																</table>
															</div>
														</div>
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>';
			}
			if ($getServiceInfo['offer_type'] == "newrk") {
				$main_content .= '
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
																<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																	<tr>
																		<td class="LabelV150">Generate a new recovery key to account ?</td>
																		<td>' . $account_logged->getName() . '</td>
																	</tr>
																</table>
															</div>
														</div>
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>';
			}
			if ($getServiceInfo['offer_type'] == "changeaccountname") {
				$main_content .= '
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
																<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																	<tr>
																		<td class="LabelV150">Type a new Accoun Name</td>
																		<td><input type="text" name="newaccountname" size="30"></td>
																	</tr>
																</table>
															</div>
														</div>
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>';
			}
		}
		$main_content .= '
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="SubmitButtonRow" >
						<div class="LeftButton" >
								<input type="hidden" name="active_service" value="yes">
								<input type="hidden" name="serviceID" value="' . $_REQUEST['serviceID'] . '">
								<input type="hidden" name="serviceInfo" value="' . $getServiceInfo['id'] . '">
								<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Submit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" >
									</div>
								</div>
							</form>
						</div>
						<div class="RightButton" >
							<form action="?subtopic=accountmanagement&action=manage" method="post" style="padding:0px;margin:0px;" >
								<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
									</div>
								</div>
							</form>
						</div>
					</div>';
	}
}
