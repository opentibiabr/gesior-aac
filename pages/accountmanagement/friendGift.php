<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:22
 */

$orderID = (int) $_REQUEST['serviceID'];
$getPaymentInfo = $SQL->prepare("SELECT * FROM `z_shop_payment` WHERE `id` = :orderid AND `account_name` = :accname");
$getItemInfo->execute(['orderid' => $orderID, 'accname' => $account_logged->getName()]);
$getItemInfo->fetch();

if ($getPaymentInfo['account_name'] != $account_logged->getName())
	header("Location: ./?subtopic=accountmanagement&action=manage");
$getItemInfo = $SQL->prepare("SELECT * FROM `z_shop_offer` WHERE `id` = :serviceid");
$getItemInfo->execute(['serviceid' => $getPaymentInfo['service_id']]);
$getItemInfo->fetchAll();

if ($_POST['transferService'] == "yes") {

	$friend_account_name = $_REQUEST['friendAccount'];
	$serviceId = (int) $_REQUEST['giftID'];

	$transfer_service = $SQL->prepare("UPDATE `z_shop_payment` SET `account_name` = :accname WHERE `id` = :orderid");
	$transfer_service->execute(['accname' => $friend_account_name, 'orderid' => $orderID]);
	if ($transfer_service)
		$main_content .= '
							<div class="TableContainer" >
								<table class="Table1" cellpadding="0" cellspacing="0" >
									<div class="CaptionContainer" >
										<div class="CaptionInnerContainer" >
											<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<div class="Text" >Successfully Transferred Service.</div>
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
														<td>You sent the service to your friend successfully.</td>
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
} else {
	$main_content .= '<p>You can only transfer service to a friend who is added to your <strong>vip list (in-game)</strong>. Below, choose the friend and click "Submit".</p> <p>Ps: If your friend is not down is because you recently added, then exit and re-enter on your character in the game, then press F5 will appear here.</p>';
	$main_content .= '
				<form method="post" action="">
				<div class="TableContainer" >
					<table class="Table1" cellpadding="0" cellspacing="0" >
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" >
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
								<div class="Text" >Transfer ' . $getItemInfo['offer_name'] . ' to Friend</div>
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
											<td class="LabelV">Transfer to friend:</td>
											<td>
												<select name="friendAccount">';
	$getVipList = $SQL->prepare("SELECT `player_id` FROM `account_viplist` WHERE `account_id` = :account_id");
	$getVipList->execute(['account_id' => $account_logged->getID()]);
	$getVipList->fetchAll();
	foreach ($getVipList as $vip) {
		$player_vip = new Player();
		$player_vip->loadById($vip['player_id']);

		$main_content .= '<option value="' . $player_vip->getAccount()->getName() . '">' . $player_vip->getName() . '</option>';
	}
	$main_content .= '
												</select>
												<input type="hidden" name="giftID" value="' . $orderID . '">
											</td>
											<td>
												<TABLE BORDER=0 WIDTH=100%>
													<TR>
														<TD ALIGN=center>
															<input type="hidden" name="transferService" value="yes">
															<table border="0" cellspacing="0" cellpadding="0" >
																<tr>
																	<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
																			<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
																				<input class="ButtonText" id="playerGift" type="image" name="Submit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" >
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
															</form>
														</TD>
													</TR>
												</TABLE>
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
