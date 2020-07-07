<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:23
 */

$getProdutsCat = $SQL->query("SELECT * FROM `z_shop_category` WHERE `hide` = 0 ORDER BY `id` ASC")->fetchAll();

if ($account_logged->getPremDays() > 0)
	$account_status = '<b><font class="green">Premium Account, ' . $account_logged->getPremDays() . ' days left</font></b>';
else
	$account_status = '<b><font class="red">Free Account</font></b>';

$main_content .= '
			<div class="SmallBox" >
				<div class="MessageContainer" >
					<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
					<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
					<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
					<div class="Message">
						<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
						<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
						<table style="width:100%;" >
							<td style="width:100%;text-align:center;" ><nobr>[<a href="#General+Information" >General Information</a>]</nobr> <nobr>[<a href="#Loyalty+Highscore+Character" >Loyalty Highscore Character</a>]</nobr> <nobr>[<a href="#Donates" >Donates</a>]</nobr> ' . ((count($getProdutsCat) >= 1) ? '<nobr>[<a href="#Products+Available" >Products Available</a>]</nobr>' : '') . ' <nobr>[<a href="#Products+Ready+To+Use" >Products Ready To Use</a>]</nobr> <nobr>[<a href="#History" >History</a>]</nobr> <nobr>[<a href="#Registration" >Registration</a>]</nobr></td>
							<td>
								<table border="0" cellspacing="0" cellpadding="0" >
									<form action="?subtopic=accountmanagement" method="post" >
										<tr>
											<td style="border:0px;" >
												<input type="hidden" name=page value=overview >
												<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
													<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
													<input class="ButtonText" type="image" name="Overview" alt="Overview" src="' . $layout_name . '/images/global/buttons/_sbutton_overview.gif" >
												</div>
											</div>
										</td>
									</tr>
									</form>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
				<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
				<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
			</div>
		</div>
		<br/>';

$main_content .= '
			<a name="General+Information" ></a>
			<div class="TopButtonContainer" >
				<div class="TopButton" >
					<a href="#top" >
						<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
					</a>
				</div>
			</div>
			<div class="TableContainer" >
				<table class="Table3" cellpadding="0" cellspacing="0" >
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" >
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<div class="Text" >General Information</div>
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
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%" >
														<tr style="background-color:#D4C0A1;" >
															<td class="LabelV" >Account Name:</td>
															<td style="width:90%;" >
																<div style="position:relative;width:100%;" >
																	<span id="DisplayAccountID" >' . str_repeat('*', strlen(htmlspecialchars($account_logged->getName()))) . '</span>
																	<span id="MaskedAccountID" style="visibility:hidden;display:none" >' . str_repeat('*', strlen(htmlspecialchars($account_logged->getName()))) . '</span>
																	<span id="ReadableAccountID" style="visibility:hidden;display:none" >' . htmlspecialchars($account_logged->getName()) . '</span>
																	<img id="ButtonAccountID" onMouseDown="ToggleMaskedText(\'AccountID\');" style="position:absolute;right:0px;top:2px;cursor:pointer;" src="' . $layout_name . '/images/global/general/show.gif" />
																</div>
															</td>
														</tr>
														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV" >Email Address:</td>
															<td style="width:90%;" >
																<div style="position:relative;width:100%;" >
																	<span id="DisplayEMail" >' . str_repeat('*', strlen(htmlspecialchars($account_logged->getEmail()))) . '</span>
																	<span id="MaskedEMail" style="visibility:hidden;display:none" >' . str_repeat('*', strlen(htmlspecialchars($account_logged->getEmail()))) . '</span>
																	<span id="ReadableEMail" style="visibility:hidden;display:none" >' . htmlspecialchars($account_logged->getEmail()) . '</span>
																	<img id="ButtonEMail" onMouseDown="ToggleMaskedText(\'EMail\');" style="position:absolute;right:0px;top:2px;cursor:pointer;" src="' . $layout_name . '/images/global/general/show.gif" />
																</div>
															</td>
														</tr>
														<tr style="background-color:#D4C0A1;" >
															<td class="LabelV" >Created:</td>
															<td>' . date("M d Y, G:i:s", $account_logged->getCreateDate()) . '</td>
														</td>';
$getLastLogin = $SQL->query("SELECT `lastlogin` FROM `players` WHERE `account_id` = '" . $account_logged->getID() . "' ORDER BY `lastlogin` DESC LIMIT 1")->fetch();
$main_content .= '
														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV" >Last Login:</td>
															<td>' . (($getLastLogin['lastlogin'] > 0) ? date("M d Y, G:i:s", $getLastLogin['lastlogin']) : 'You never logged in the game.') . '</td>
														</tr>';
$main_content .= '
														<tr style="background-color:#D4C0A1;" >
															<td class="LabelV" >Account Status:</td>';
if ($config['server']['freePremium'] == "yes") {
	$main_content .= '
															<td>
																<b><font class="green">Premium Account</font></b><br>
															</td>';
} else {
	$main_content .= '
															<td>' . $account_status . '<br>
																<small>(Premium Time expires at Dec&#160;20&#160;2014,&#160;21:50:32&#160;CET)</small>
															</td>';
}
$main_content .= '
														</tr>
														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV" >Tibia Coins:</td>
															<td>' . $account_logged->getPremiumPoints() . ' tibia coins<br>';
$accname = $account_logged->getName();
//INSERT INTO `pagseguro_transactions`(`transaction_code`, `name`, `payment_method`, `status`, `item_count`, `data`, `payment_amount`)
$sql_points = "SELECT * FROM `pagseguro_transactions` WHERE `name` = '$accname' AND `status` = 'PAID' ORDER BY `data` DESC LIMIT 1";
$last_points_bought = $SQL->query($sql_points)->fetch();
if ($last_points_bought) {
	$getServiceInfo = $SQL->query("SELECT `count` FROM `z_shop_offer` WHERE `id` = '" . $last_points_bought['service_id'] . "'")->fetch();
	$main_content .= '
															<small>(Your last donation was on ' . date("M d Y", strtotime($last_points_bought['data'])) . '. You donated to get ' . $last_points_bought['item_count'] . ' Tibia Coins.)</small>';
} else
	$main_content .= '
																<small>(You have not donated to get tibia coins yet. <a href="?subtopic=accountmanagement&action=donate" title="Buy now!">Buy now!</a>)</small>';
$main_content .= '
															</td>
														</tr>';
$accountTitle = ''; // none
foreach ($loyalty_title as $loypoints => $loytitle) {

	if ($account_logged->getLoyalty() >= $loypoints) {
		# player rank
		$accountTitle = $loytitle;
	} else {
		// first rank after geting highest title
		$nextTitle = $loytitle;
		$nextPoints = $loypoints;
		break;
	}
}
if ($accountTitle != '')
	$loyaltyTitle = $accountTitle . ' of ' . $config['server']['serverName'] . (($nextPoints == 0) ? ' (You got the most highest title in the ' . $config['server']['serverName'] . '.)' : ' (Promotion to: ' . $nextTitle . ' of ' . $config['server']['serverName'] . ' at ' . $nextPoints . ' Loyalty Points)');
else
	$loyaltyTitle = 'No title (Promotion to: Scout of ' . $config['server']['serverName'] . ' at 50 Loyalty Points)';

$main_content .= '
														<tr style="background-color:#D4C0A1;">
															<td class="LabelV">Loyalty Points</td>
															<td>' . $account_logged->getLoyalty() . '</td>
														</tr>
														<tr style="background-color:#F1E0C6;" >
															<td class="LabelV">Loyalty Title</td>
															<td>' . $loyaltyTitle . '</td>
														</tr>';
$main_content .= '
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
										</tr>
										<tr>
											<td width="30%">
												<table class="InnerTableButtonRow" cellpadding="0" cellspacing="0" >
													<tr>
														<td>
															<table border="0" cellspacing="0" cellpadding="0" >
																<form action="?subtopic=accountmanagement&action=changepassword" method="post" >
																	<tr>
																		<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																				<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																					<input class="ButtonText" type="image" name="Change Password" alt="Change Password" src="' . $layout_name . '/images/global/buttons/_sbutton_changepassword.gif" >
																				</div>
																			</div>
																		</td>
																	</tr>
																</form>
															</table>
														<td>
														<td width="80%">
															<table border="0" cellspacing="0" cellpadding="0" >
																<form action="?subtopic=accountmanagement&action=changeemail" method="post" >
																	<tr>
																		<td style="border:0px;" >
																			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																				<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																					<input class="ButtonText" type="image" name="Change Email" alt="Change Email" src="' . $layout_name . '/images/global/buttons/_sbutton_changeemail.gif" >
																				</div>
																			</div>
																		</td>
																	</tr>
																</form>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
							</table>
						</div>
					</td>
				</tr>
				<br/>';

$main_content .= '
			<a name="Loyalty+Highscore+Character" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<form action="?subtopic=accountmanagement" method="post">
					<div class="TableContainer" >
						<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" >
									<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Loyalty Highscore Character</div>
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
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td>
																		<div style="float:right;" >
																			<input type="hidden" name="step" value="setloyaltycharacter" >
																				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																					<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																						<input class="ButtonText" type="image" name="Submit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" >
																			</div>
																		</div>
																	</div>
																	<b>Selected Character for Loyalty Highscores</b>&nbsp;&nbsp;&nbsp;
																	<select name="character" size="1">';
foreach ($account_logged->getPlayersList() as $players) {
	if (!$players->isHidden())
		$main_content .= '
																				<option value="' . $players->getName() . '">' . $players->getName() . '</option>';
}
$main_content .= '
																	</select>
																	<br/>
																	Please note that you can only select characters here which are not hidden. <br />
																	Hidden characters are not displayed in the Loyalty Highscores!</td>
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
										</tr>
									</form>
								</table>
							</div>
						</td>
					</tr>
				</table>
			</div>
				<br>';

$main_content .= '
			<div class="TableContainer" style="margin-bottom: 10px">
				<div class="CaptionContainer">
					<div class="CaptionInnerContainer">
						<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
						<span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
						<span class="CaptionBorderTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);"></span>
						<span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
						<div class="Text">Authenticator</div>
						<span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
						<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);"></span>
						<span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
						<span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
					</div>
				</div>
				<table class="Table5" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<td>
								<div class="InnerTableContainer">
									<table style="width:100%;">
										<tbody>
											<tr>
												<td>
													<div class="TableShadowContainerRightTop">
														<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);">
														</div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
														<div class="TableContentContainer">
															<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																<tbody>
																	<tr>
																		<td>
																			<div style="float: right; width: 135px;">
																				<form id="requestSecret" action="?subtopic=accountmanagement&action=auth" method="post" style="padding:0px;margin:0px;">
																					<div class="BigButton" style="background-image:url(./layouts/tibiacom/images/global/buttons/sbutton.gif)">
																						<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image: url(&quot;./layouts/tibiacom/images/global/buttons/sbutton_over.gif&quot;); visibility: hidden;"></div>
																							<input class="ButtonText" type="image" name="Request" alt="Request" src="./layouts/tibiacom/images/global/buttons/_sbutton_request.gif">
																						</div>
																					</div>
																				</form>
																			</div>
																			<b>Connect your Tibia account to an authenticator!</b>
																			<p>An authenticator offers you an additional layer of security to help prevent unauthorised access to your Tibia account.</p>
																			<p>As a first step to connect an authenticator to your account, click on "Request"! An email with a confirmation key will be sent to the email address assigned to your account.</p>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													<div class="TableShadowContainer">
														<div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);">
															<div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);">
															</div>
															<div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		';

$main_content .= '
			<a name="Donates" ></a>
			<div class="TopButtonContainer" >
				<div class="TopButton" >
					<a href="#top" >
						<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
					</a>
				</div>
			</div>
			<div class="TableContainer" >
				<table class="Table3" cellpadding="0" cellspacing="0">
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" >
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<div class="Text" >Donates</div>
							<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						</div>
					</div>
					<tr>
						<td>
							<div class="InnerTableContainer" >
								<table style="width:100%;" >';
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
															<td><div style="float: right; width: 135px;" >
																	<form action="?subtopic=accountmanagement&action=donate" method="post" style="padding:0px;margin:0px;" >
																		<input type="hidden" name="step" value="1" >
																		<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																			<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																				<input class="ButtonText" type="image" name="Donate" alt="Donate" src="' . $layout_name . '/images/global/buttons/_sbutton_gettibiacoins.gif" >
																			</div>
																		</div>
																	</form>
																	<div style="font-size:1px;height:4px;" ></div>
																	<form action="?subtopic=accountmanagement&action=donateshistory" method="post" style="padding:0px;margin:0px;" >
																		<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																			<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																				<input class="ButtonText" type="image" name="View History" alt="View History" src="' . $layout_name . '/images/global/buttons/_sbutton_viewhistory.gif" >
																			</div>
																		</div>
																	</form>
																</div>
																<b>Donate to ' . $config['server']['serverName'] . '</b> <span style=" margin-left: 5px;" ><span class="HelperDivIndicator" onMouseOver="ActivateHelperDiv($(this), \'Information:\', \'Just click on donate if really interested in helping the server to grow.<br/><br/>If you have more than 3 donations unconfirmed or false , your account may be banned, or even permanent exclusion.\', \'\');" onMouseOut="$(\'#HelperDivContainer\').hide();" >
																							<image style="border:0px;" src="' . $layout_name . '/images/global/content/info.gif" />
																							</span></span><br/>
																Your donations are an incentive for us always bring the best.<br/>
																<ul>
																	<li>Your donations will be reversed in tibia coins.</li>
																	<li>Note that some types of donations need to be confirmed. Will be listed below the outstanding donations that needs confirmation.</li>
																</ul>
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
$getDonates = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `status` = 'confirm' AND `account_name` = '" . $account_logged->getName() . "'")->fetchAll();
$num = 0;
if (!empty($getDonates[0])) {
	$main_content .= '
									<tr>
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
														<tr bgcolor="' . $config['site']['darkborder'] . '">
															<td class="LabelV" width="15%">Date</td>
															<td class="LabelV">Service</td>
															<td width="10%"></td>
														</tr>';
	foreach ($getDonates as $donate) {
		$bgcolor = (($num++ % 2 == 1) ? $config['site']['darktborder'] : $config['site']['lightborder']);
		$main_content .= '
														<tr bgcolor="' . $bgcolor . '">
															<td>' . date("M d Y", $donate['date']) . '</td>
															<td>' . $donate['coins'] . ' coins por R$ ' . $donate['price'] . '</td>
															<td>[<a href="?subtopic=accountmanagement&action=confirmdonate&id=' . $donate['id'] . '">Confirm</a>]</td>
														</tr>';
	}
	$main_content .= '
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
$main_content .= '
								</table>
							</div>
						</table>
					</div>
				</td>
			</tr>
			<br/>';

$main_content .= '
			<a name="Products+Available" ></a>
			<div class="TopButtonContainer" >
				<div class="TopButton" >
					<a href="#top" >
						<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
					</a>
				</div>
			</div>
			<div class="TableContainer" >
				<table class="Table5" cellpadding="0" cellspacing="0">
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" >
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<div class="Text" >Products Available</div>
							<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						</div>
					</div>
					<tr>
						<td><div class="InnerTableContainer" >
								<table style="width:100%;" >';

foreach ($getProdutsCat as $choiceCats) {
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
																<td>
																	<b>' . $choiceCats['name'] . '</b>
																	<div style="float:right;" >
																		<form action="?subtopic=accountmanagement&action=services" method="post" style="padding:0px;margin:0px;" >
																			<input type="hidden" name="ServiceCategoryID" value="' . $choiceCats['id'] . '" >
																			<input type="hidden" name="step" value="1" >
																			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
																				<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
																					<input class="ButtonText" type="image" name="Get ' . $choiceCats['name'] . '" alt="Get ' . $choiceCats['name'] . '" src="' . $layout_name . '/images/global/buttons/' . $choiceCats['button'] . '" >
																				</div>
																			</div>
																		</form>
																	</div>
																	<br/>
																	' . $choiceCats['desc'] . '</td>
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


$main_content .= '
								</table>
							</div>
						</table>
					</div>
				</td>
			</tr>
			<br/>';

$main_content .= '
			<a name="Products+Ready+To+Use" ></a>
			<div class="TopButtonContainer" >
				<div class="TopButton" >
					<a href="#top" >
						<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
					</a>
				</div>
			</div>
			<div class="TableContainer" >
				<table class="Table3" cellpadding="0" cellspacing="0">
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" >
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<div class="Text" >Products Ready To Use</div>
							<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						</div>
					</div>
					<tr>
						<td>
							<div class="InnerTableContainer" >
								<table style="width:100%;" >';
$getReadyUse = $SQL->query("SELECT * FROM `z_shop_payment` WHERE `status` = 'ready' AND `account_name` = '" . $account_logged->getName() . "' ORDER BY `date` DESC")->fetchAll();
if (count($getReadyUse) == 0)
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
															<td>You currently have no products available to use.</td>
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
else
	foreach ($getReadyUse as $ready) {
		$getServiceInfos = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `id` = '" . $ready['service_id'] . "'")->fetch();
		$main_content .= '
										<tr>
											<td>
												<div class="TableShadowContainerRightTop" >
													<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
													<div class="TableContentContainer" >
														<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
															<tr class="LabelH" >
																<td style="width: 100px;" >Date</td>
																<td>Service</td>
																<td></td>
															</tr>
															<tr style="background-color:#F1E0C6;" >
																<td>' . date("d/M/Y", $ready['date']) . '</td>
																<td>' . $getServiceInfos['offer_name'] . '</td>
																<td width="10%">[<a href="?subtopic=accountmanagement&action=readytouse&serviceID=' . $ready['id'] . '" >Active</a>]</td>';
		$main_content .= '
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
$main_content .= '
								</table>
							</div>
						</table>
					</div>
				</td>
			</tr>
			<br/>';
#history of products bought
$main_content .= '
				<a name="History" ></a>
				<div class="TopButtonContainer" >
					<div class="TopButton" >
						<a href="#top" >
							<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
						</a>
					</div>
				</div>
				<div class="TableContainer" >
					<table class="Table5" cellpadding="0" cellspacing="0">
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" >
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
								<div class="Text" >History</div>
								<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
								<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
								<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							</div>
						</div>
						<tr>
							<td>
								<div class="InnerTableContainer" >
									<table style="width:100%;" >';
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
																<td>
																	<div style="float:right;" >
																		<form action="?subtopic=accountmanagement&action=paymentshistory" method="post" style="padding:0px;margin:0px;" >
																			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																				<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																					<input class="ButtonText" type="image" name="View History" alt="View History" src="' . $layout_name . '/images/global/buttons/_sbutton_viewhistory.gif" >
																				</div>
																			</div>
																		</form>
																	</div>
																	<b>Payments History</b><br/>
																	Contains all historical data of your payments.
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
																<td>
																	<div style="float:right;" >
																		<form action="?subtopic=accountmanagement&action=donateshistory" method="post" style="padding:0px;margin:0px;" >
																			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																				<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																					<input class="ButtonText" type="image" name="View History" alt="View History" src="' . $layout_name . '/images/global/buttons/_sbutton_viewhistory.gif" >
																				</div>
																			</div>
																		</form>
																	</div>
																	<b>Donations History</b><br/>
																	Contains all historical data of your donates.
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

$main_content .= '
									</table>
								</div>
							</table>
						</div>
					</td>
				</tr>
				<br/>';
//Real life data
$main_content .= '
			<a name="Registration" ></a>
			<div class="TopButtonContainer" >
				<div class="TopButton" >
					<a href="#top" >
						<image style="border:0px;" src="' . $layout_name . '/images/global/content/back-to-top.gif" />
					</a>
				</div>
			</div>
			<div class="TableContainer" >
				<table class="Table5" cellpadding="0" cellspacing="0" >
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" >
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<div class="Text" >Registration</div>
							<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						</div>
					</div>
					<tr>
						<td><div class="InnerTableContainer" >
								<table style="width:100%;" >
									<tr>
										<td><div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%" >';
$registration = $account_logged->getKey();
if (!empty($registration)) {
	$main_content .= '
														<tr width=100%>
															<td class="LabelV" >Location:</td>
															<td width=80%>' . $account_logged->getRLName() . '<br/>
																' . $account_logged->getLocation() . ' <br/>';
	/*$main_content .= '
													<td rowspan="2" style="vertical-align:top;horizontal-align:right;padding-right:0px;" ><table border="0" cellspacing="0" cellpadding="0" >
															<form action="?subtopic=accountmanagement&page=changeregistration" method="post" >
																<tr>
																	<td style="border:0px;" ><div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
																			<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
																				<input class="ButtonText" type="image" name="Edit" alt="Edit" src="'.$layout_name.'/images/global/buttons/_sbutton_edit.gif" >
																			</div>
																		</div>
																	</td>
																</tr>
															</form>
														</table>
													</td>';
													*/
	$main_content .= '
														</tr>
														<tr>
															<td><nobr><b>Date of Birth:</b></td>
															<td>' . $account_logged->getBirthDate() . '</nobr></td>
														</tr>
														<tr>
															<td><b>Gender:</b></td>
															<td>' . $account_logged->getGender() . '</td>
														</tr>';
} else {
	$main_content .= '
														<tr>
															<td class="red" ><b>Your account is not registered yet.</b></td>
															<td align=right><table border="0" cellspacing="0" cellpadding="0" >
																	<form action="?subtopic=accountmanagement&action=registeraccount" method="post" >
																		<tr>
																			<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																					<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																						<input class="ButtonText" type="image" name="Register Account" alt="Register Account" src="' . $layout_name . '/images/global/buttons/_sbutton_registeraccount.gif" >
																					</div>
																				</div>
																			</td>
																		</tr>
																	</form>
																</table>
															</td>
														</tr>';
}

$main_content .= '
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
									</tr>
								</table>
							</div>
						</table>
					</div>
				</td>
			</tr>';
