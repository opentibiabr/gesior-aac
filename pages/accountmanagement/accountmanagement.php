<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:25
 */

if ($account_logged->getPremDays() > 0)
	$account_statusOver = '
				<span class="green">
					<span class="BigBoldText">Premium Account</span>
				</span>';
else
	$account_statusOver = '
				<span class="red">
					<span class="BigBoldText">Free Account</span>
				</span>';

if ($account_logged->getPremDays() > 0)
	$account_statusPic = '<img class="AccountStatusImage" src="' . $layout_name . '/images/account/account-status_green.gif" alt="free account">';
else
	$account_statusPic = '<img class="AccountStatusImage" src="' . $layout_name . '/images/account/account-status_red.gif" alt="free account">';

$main_content .= '
			<center>
				<table>
					<tbody>
						<tr>
							<td><img src="' . $layout_name . '/images/global/content/headline-bracer-left.gif"></td>
							<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Welcome to your account ' . $account_logged->getRLName() . '!<br></td>
							<td><img src="' . $layout_name . '/images/global/content/headline-bracer-right.gif"></td>
						</tr>
					</tbody>
				</table>
			</center>
			<br>';
$main_content .= '
			<div class="TableContainer">
				<div class="CaptionContainer">
					<div class="CaptionInnerContainer">
						<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
						<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
						<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
						<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
						<div class="Text">Account Status</div>
						<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
						<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
						<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
						<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
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
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
														<div class="TableContentContainer">
															<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																<tbody>
																	<tr>';
if ($config['server']['freePremium'] == "yes") {
	$main_content .= '
																		<td><img class="AccountStatusImage" src="' . $layout_name . '/images/account/account-status_green.gif" alt="free account"></td>
																		<td width="100%" valign="middle">
																			<span class="green">
																				<span class="BigBoldText">Premium Account</span>
																			</span>
																			<small>
																				<br>The server is configured to free premium account , good game !<br>
																				(Balance of tibia coins: ' . (($account_logged->getPremiumPoints() > 0) ? '<font class="red">' . $account_logged->getPremiumPoints() . '</font>' : '<font class="red">0</font>') . ' Coins)
																			</small>
																		</td>';
} else {
	$main_content .= '
																		<td>' . $account_statusPic . '</td>
																		<td width="100%" valign="middle">
																			' . $account_statusOver . '';
	$daysVip = $account_logged->getPremDays();
	$vipDays = $daysVip * 86400;
	$resDate = time() + $vipDays;
	$main_content .= '
																			<small><br>Your premium time expires at <font style="text-transform:capitalize;">' . strftime('%b %d %Y, %H:%M:%S', $resDate) . '</font></small>';
	$main_content .= '
																		</td>';
}
$main_content .= '
																		<td>
																			<form action="?subtopic=accountmanagement&action=manage" method="post" style="padding:0px;margin:0px;">
																				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
																					<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);">
																						</div>
																						<input class="ButtonText" type="image" name="Manage Account" alt="Manage Account" src="' . $layout_name . '/images/global/buttons/_sbutton_manageaccount.gif">
																					</div>
																				</div>
																			</form>';
$main_content .= '
																			<div style="font-size:1px;height:4px;"></div>
																				<form action="?subtopic=accountmanagement&action=donate" method="post" style="padding:0px;margin:0px;">
																					<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)">
																						<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);"></div>
																							<input class="ButtonText" type="image" name="Get Coins" alt="Get Coins" src="' . $layout_name . '/images/global/buttons/_sbutton_gettibiacoins.gif">
																						</div>
																					</div>
																				</form>';
if ($group_id_of_acc_logged >= $config['site']['access_admin_panel']) {
	$main_content .= '
																				<div style="font-size:1px;height:4px;"></div>
																				<form action="?subtopic=adminpanel" method="post" style="padding:0px;margin:0px;">
																					<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)">
																						<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);"></div>
																							<input class="ButtonText" type="image" name="Logout" alt="Logout" src="' . $layout_name . '/images/global/buttons/_sbutton_painel.gif">
																						</div>
																					</div>
																				</form>';
}
//if($config['server']['freePremium'] == "no" || $account_logged->getPremDays() > 0)
$main_content .= '
																				<div style="font-size:1px;height:4px;"></div>
																				<form action="?subtopic=accountmanagement&action=logout" method="post" style="padding:0px;margin:0px;">
																					<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)">
																						<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);"></div>
																							<input class="ButtonText" type="image" name="Logout" alt="Logout" src="' . $layout_name . '/images/global/buttons/_sbutton_logout.gif">
																						</div>
																					</div>
																				</form>';
$main_content .= '
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
														<div class="TableShadowContainer">
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
														</div>
														</div>';

$main_content .= '
														<tr>
														<td>
														<div class="TableShadowContainerRightTop">
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif)"></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif)">
														<div class="TableContentContainer">
														<table class="TableContent" width="100%">
														<tr>
														<style> .premiumbenefits {display: flex;margin: 0px auto;} .premiumbenefits > div { display: flex;align-items: center;flex: 1; margin: auto 5x;</style>
														<td class="premiumbenefits"><div style="justify-content: flex-start">
														<img class="PremiumFeatureImage1" src="' . $layout_name . '/images/premiumfeatures/PremiumIcon-Stamina.png" alt="premium feature 1" style="margin:0px 5px"/>
														<div>50% XP boost for 2 hours every day</div></div>
														<div style="justify-content: center">
														<img class="PremiumFeatureImage1" src="' . $layout_name . '/images/premiumfeatures/PremiumIcon-Death.png" alt="premium feature 1" style="margin:0px 5px"/>
														<div>lose 30% less on death with a promotion</div></div>
														<div style="justify-content: flex-end">
														<img class="PremiumFeatureImage1" src="' . $layout_name . '/images/premiumfeatures/PremiumIcon-Travel.png" alt="premium feature 1" style="margin:0px 5px"/>
														<div>use instant travel system</div></div></td></tr>    </table>  </div></div>
														';

$main_content .= '
														<div class="TableShadowContainer">
															<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
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
			<br>';


$main_content .= '
				<div class="TableContainer">
					<div class="CaptionContainer">
							<div class="CaptionInnerContainer">
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Tickets</div>
								<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							</div>
						</div><table class="Table3" cellpadding="0" cellspacing="0">
						<tbody><tr>
							<td>
								<div class="InnerTableContainer">
										<table style="width:100%;">
											<tbody><tr>
												<td>
													<div class="TableShadowContainerRightTop">
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
														<div class="TableContentContainer">
															<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																<tbody><tr>
																	<td>
																		<div style="float: right; margin-top: 7px;">
																			<form action="?subtopic=ticket" method="post" style="padding:0px;margin:0px;">
																				<div class="MediumButtonBackground" style="background-image:url(' . $layout_name . '/images/global/buttons/mediumbutton.gif)" onmouseover="MouseOverMediumButton(this);" onmouseout="MouseOutMediumButton(this);"><div class="MediumButtonOver" style="background-image: url(&quot;' . $layout_name . '/images/global/buttons/mediumbutton-over.gif&quot;); visibility: hidden;" onmouseover="MouseOverMediumButton(this);" onmouseout="MouseOutMediumButton(this);"></div><input class="MediumButtonText" type="image" name="Open Ticket" alt="Open Ticket" src="' . $layout_name . '/images/global/buttons/open_ticket.png"></div>
																			</form>
																		</div>
																		<b>Open a support ticket</b>
																		<span class="HelperDivIndicator" onMouseOver="ActivateHelperDiv($(this), \'Ticket System:\', \'<p><b>Recommended:</b><ul><li>Fill in all required fields.</li><li>Lack of respect for inappropriate use will have consequences.</li><li>If necessary post screenshots to facilitate our understanding of the problem.</li></ul>\', \'\');" onMouseOut="$(\'#HelperDivContainer\').hide();" >
																		<img style="border:0px;" src="' . $layout_name . '/images/global/content/info.gif"></span></a></span>
																		</span></span><br>
																		<small>Support for the various questions you have.</small><br>
																		<p>Use this tool with caution because only then can we work for the server progress, help us know what problems you have faced along his journey through in ' . $config['server']['serverName'] . '.</p>
																	</td>
																</tr>
															</tbody></table>
														</div>
													</div>
													<div class="TableShadowContainer">
														<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
															<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
															<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
														</div>
													</div>
												<p/>
												<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="TableContent" width="100%">
															<tbody>
															<tr style="background-color:#D4C0A1;">
																	<td class="LabelV">Ticket</td>
																	<td class="LabelV">Player</td>
																	<td class="LabelV">Subject</td>
																	<td class="LabelV">Status</td>
																	<td class="LabelV">Last answer</td>
																	<td class="LabelV">Category</td>
															</tr>';
$account_id = $account_logged->getID();
$tickets = $SQL->query("SELECT * FROM `tickets` WHERE `ticket_author_acc_id` = " . $account_id . " ORDER BY `ticket_date` DESC LIMIT 5");
if ($tickets) {
	foreach ($tickets as $tickets_content) {
		$main_content .= "
																<tr>
																	<td><a href='?subtopic=ticket&amp;action=showticket&amp;do=number&amp;id={$tickets_content['ticket_id']}'>#{$tickets_content['ticket_id']}</a></td>
																	<td><a href='?subtopic=characters&amp;name={$tickets_content['ticket_author']}'>{$tickets_content['ticket_author']}</td>
																	<td>{$tickets_content['ticket_subject']}</td>";
		if ($tickets_content['ticket_status'] == "Waiting") {
			$main_content .= "
																	<td style='color: gray !important;'>{$tickets_content['ticket_status']}</td>";
		} elseif ($tickets_content['ticket_status'] == "Closed") {
			$main_content .= "
																	<td style='color: red !important;'>{$tickets_content['ticket_status']}</td>";
		} else {
			$main_content .= "
																	<td>{$tickets_content['ticket_status']}</td>";
		}
		$main_content .= "
																	<td>{$tickets_content['ticket_last_reply']}</td>
																	<td>{$tickets_content['ticket_category']}</td>
																</tr>
																";
	}
}


$main_content .= '
															<tr bgcolor="#D4C0A1">
																<td align="left" colspan="5"><small>To see all your tickets click on <i>Show all</i></small></td>
																<td><a href="?subtopic=accountmanagement&action=showtickets"><small>Show All</small></a></td>
															</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
														<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
														<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
													</div>
												</div>
											</td>
										</tr>
									</tbody></table>
								</div>
							</td>
						</tr>
					</tbody></table>
				</div><br>';

$main_content .= '
				<div class="TableContainer" >
				<table class="Table5" cellpadding="0" cellspacing="0">
				<div class="CaptionContainer" >
				<div class="CaptionInnerContainer" >
				<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
				<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
				<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
				<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
				<div class="Text" >Download Client</div>
				<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
				<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
				</div>
				</div>
				<tr>
				<td>
				<div class="InnerTableContainer" >
				<table style="width:100%;" ><tr><td><div class="TableShadowContainerRightTop" >
				<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" >
				</div></div><div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
				<div class="TableContentContainer" >
				<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
				<tr><td><div style="height: 55px;" ><div id="DowloadBox" style="position: relative; float:right;" >
				<a href="?subtopic=downloadclient" >
				<img style="width: 45px; height: 45px; border: 0px; margin-right: 10px;" src="' . $layout_name . '/images/account/download_windows.gif" /></a>
				<br/>
				<a style="position: absolute; bottom: -5px; right: 0px;" href="?subtopic=downloadclient" >Download</a></div>
				<span style="position: relative; top: 18px;" >Click <a href="?subtopic=downloadclient" >here</a> to download the latest Tibia client!</span>
				</div></td></tr>    </table>  </div></div><div class="TableShadowContainer" >
				<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);" >
				<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);" >
				</div>
				<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);" ></div>
				</div></div></td></tr>          </table>        </div>      </td>    </tr>  </table></div><br/>
					';
//REGISTRAR
$account_reckey = $account_logged->getCustomField("key");
if (empty($account_reckey))
	$main_content .= '
				<div class="SmallBox" >
					<div class="MessageContainer" >
						<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
						<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
						<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
						<div class="Message" >
							<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
							<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
							<table class="HintBox" >
								<tr>
									<td>
										<div class="BoxButtons" >
											<form action="?subtopic=accountmanagement&action=registeraccount" method="post" style="padding:0px;margin:0px;" >
												<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
													<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" >
														<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
														<input class="ButtonText" type="image" name="Register Account" alt="Register Account" src="' . $layout_name . '/images/global/buttons/_sbutton_registeraccount.gif" >
													</div>
												</div>
											</form>
											<div style="font-size:1px;height:4px;" ></div>
										</div>
										<p><b>Your account is not registered!</b></p>
										<p>You can register your account for increased protection. Click on "Register Account" and get your free recovery key today!</p>
									</td>
								<tr>
							</table>
						</div>
						<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
							<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
							<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
						</div>
					</div><br/>';
//IF BANK TRANSFER TO CONFIRM
//if(empty($account_reckey))
$getTransfer = $SQL->query("SELECT COUNT(*) FROM `z_shop_donates` WHERE `status` = 'confirm' AND `account_name` = '" . $account_logged->getName() . "'")->fetch();
if ($getTransfer[0] > 0) {
	$main_content .= '
					<div class="SmallBox" >
						<div class="MessageContainer" >
							<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
							<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
							<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
							<div class="Message" >
								<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
								<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
								<table class="HintBox" >
									<tr>
										<td>
											<div class="BoxButtons" >
												<form action="?subtopic=accountmanagement&action=paymentshistory" method="post" style="padding:0px;margin:0px;" >
													<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
														<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" >
															<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
															<input class="ButtonText" type="image" name="Confirm Transfer" alt="Confirm Transfer" src="' . $layout_name . '/images/global/buttons/_sbutton_confirm.gif" >
														</div>
													</div>
												</form>
												<div style="font-size:1px;height:4px;" ></div>
											</div>
											<p><b>' . $getTransfer[0] . ' donate' . (($getTransfer[0] >= 2) ? 's' : '') . ' pending of confirmation!</b></p>
											<p>You bought tibia coins in our shop using or donate system, but need to confirm your donation. Click "Confirm" to see which donate is pending confirmation.</p>
										</td>
									<tr>
								</table>
							</div>
							<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
								<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
								<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
							</div>
						</div><br/>';
}
//IF BANK TRANSFER TO CONFIRM ADMIN
//if(empty($account_reckey))
if ($group_id_of_acc_logged >= $config['site']['access_admin_panel']) {
	$getTransferAdmin = $SQL->query("SELECT COUNT(*) FROM `z_shop_donates` WHERE `status` = 'confirmed'")->fetch();
	if ($getTransferAdmin[0] > 0) {
		$main_content .= '
					<div class="SmallBox" >
						<div class="MessageContainer" >
							<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
							<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
							<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
							<div class="Message" >
								<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
								<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
								<table class="HintBox" >
									<tr>
										<td>
											<div class="BoxButtons" >
												<form action="?subtopic=adminpanel&action=history" method="post" style="padding:0px;margin:0px;" >
													<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
														<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" >
															<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
															<input class="ButtonText" type="image" name="Confirm Transfer" alt="Confirm Transfer" src="' . $layout_name . '/images/global/buttons/_sbutton_confirm.gif" >
														</div>
													</div>
												</form>
												<div style="font-size:1px;height:4px;" ></div>
											</div>
											<p><b>' . $getTransferAdmin[0] . ' donate' . (($getTransfer[0] >= 2) ? 's' : '') . ' confirmed!</b></p>
											<p>You have some donate confirmations. Confirm and give the tibia coins to the player.</p>
										</td>
									<tr>
								</table>
							</div>
							<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
								<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
								<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
							</div>
						</div><br/>';
	}
}
//CHARACTERS
$main_content .= '
				<div class="RowsWithOverEffect">
					<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer">
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Characters</div>
								<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							</div>
						</div>
						<table class="Table3" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>
													<tr>
														<td>
															<div class="TableShadowContainerRightTop">
																<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
															</div>
															<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
																<div class="TableContentContainer">
																	<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																		<tbody>
																			<tr class="LabelH">
																				<td></td>
																				<td style="width:40%;">Name</td>
																				<td style="width:120px!important;">World</td>
																				<td style="width:90px!important;">Status</td>
																				<td style="width:90px!important;">&nbsp;</td>
																			</tr>';

$account_players = $account_logged->getPlayersList();
//show list of players on account
$var = 0;
foreach ($account_players as $account_player) {
	$player_number_counter++;

	if ($var == 0) {
		$preview = ' previewstate="0"';
		$display = 'block';
		$displayNum = 'none';
		$displayBold = 'bold';
		$displayFont = '13';
	} else {
		$preview = '';
		$display = 'none';
		$displayNum = 'inline';
		$displayBold = 'normal';
		$displayFont = '10';
	}

	$main_content .= '
																			<tr id="CharacterRow_' . $player_number_counter . '"
																				onmouseover="InRowWithOverEffect(&#39;CharacterRow_' . $player_number_counter . '&#39;,';

	if (is_int($player_number_counter / 2))
		$main_content .= '&#39;#e7d1af&#39;';
	else
		$main_content .= '&#39;#ffedd1&#39;';


	$main_content .= '
																				);"
																				onmouseout="OutRowWithOverEffect(&#39;CharacterRow_' . $player_number_counter . '&#39;,';

	if (is_int($player_number_counter / 2))
		$main_content .= '&#39;#d5c0a1&#39;';
	else
		$main_content .= '&#39;#f1e0c6&#39;';

	$main_content .= '
																				);"
																				onclick="FocusCharacter(' . $player_number_counter . ', &#39;' . urlencode($account_player->getName()) . '&#39;, ' . $config['site']['max_players_per_account'] . ');"
																				class="Odd" style="font-weight: ' . $displayBold . ';';

	if (is_int($player_number_counter / 2))
		$main_content .= 'background-color: #d5c0a1;">';
	else
		$main_content .= 'background-color: #f1e0c6;">';


	$main_content .= '
																				<td style="width:40px;text-align:center;padding:2px;">
																					<span id="CharacterNumberOf_' . $player_number_counter . '" style="display: ' . $displayNum . ';">' . $player_number_counter . '.</span>
																					<span id="PlayButtonOf_' . $player_number_counter . '" style="display: ' . $display . ';">
																						<!--<span name="FlashClientPlayButton" id="FlashClientPlayButton" playlink="?subtopic=play&name=' . htmlspecialchars($account_player->getName()) . '" ' . $preview . '> -->';

	if ($account_player->isDeleted()) {
		$main_content .= '<img style="border:0px;" src="' . $layout_name . '/images/account/play-not-button.gif">';
	} else if (!$config['site']['flash_client_enabled']) {
		$main_content .= '<img style="border:0px;" alt="Flash client disabled" src="' . $layout_name . '/images/account/play-button-disabled.gif">';
	} else {
		$main_content .= '
																								<img style="border:0px;" onmouseover="InMiniButton(this, &#39;&#39;);" onmouseout="OutMiniButton(this, &#39;&#39;);" src="' . $layout_name . '/images/account/play-button.gif">';
	}

	$main_content .= '
																						<!-- </span> -->
																					</span>
																				</td>
																				<td id="CharacterCell2_' . $player_number_counter . '">
																					<span style="white-space:nowrap;vertical-align:middle;">
																						<span id="CharacterNameOf_' . $player_number_counter . '" style="font-size: ' . $displayFont . 'pt;">' . htmlspecialchars($account_player->getName()) . '</span><br>
																						<span id="CharacterNameOf_' . $player_number_counter . '"><small>' . htmlspecialchars(Website::getVocationName($account_player->getVocation())) . ' - Level ' . $account_player->getLevel() . '</small></span>
																					</span>
																				</td>
																				<td id="CharacterCell2_' . $player_number_counter . '">
																					<span style="white-space:nowrap;">' . htmlspecialchars($config['server']['serverName']) . '</span>
																				</td>
																				<td id="CharacterCell3_' . $player_number_counter . '">';
	if ($account_player->isDeleted())
		$main_content .= 'deleted';
	else {
		if ($account_player->isOnline() && $account_player->isHidden())
			$main_content .= 'hidden, <font class="green"><b>online</b></font>';
		elseif ($account_player->isOnline())
			$main_content .= '<font class="green"><b>online</b></font>';
		elseif ($account_player->isHidden())
			$main_content .= 'hidden';
	}
	$main_content .= '
																				</td>
																				<td id="CharacterCell4_' . $player_number_counter . '" style="text-align:center;">
																					<span id="CharacterOptionsOf_' . $player_number_counter . '" style="display: ' . $display . ';">
																						<span style="font-weight:normal;">[<a href="?subtopic=accountmanagement&action=changecharacterinformation&name=' . urlencode($account_player->getName()) . '">Edit</a>]</span>';
	if ($account_player->isDeleted()) {
		$main_content .= '<br><span style="font-weight:normal;">[<a href="?subtopic=accountmanagement&action=undeletecharacter&name=' . urlencode($account_player->getName()) . '">Undelete</a>]</span>';
	} else {
		$main_content .= '<br><span style="font-weight:normal;">[<a href="?subtopic=accountmanagement&action=deletecharacter&name=' . urlencode($account_player->getName()) . '">Delete</a>]</span>';
	}

	$main_content .= '
																					</span>
																				</td>
																			</tr>';
	$var++;
}
$main_content .= '
																		</tbody>
																	</table>
																</div>
															</div>
															<div class="TableShadowContainer">
																<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
																	<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
																	<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<table class="InnerTableButtonRow" cellpadding="0" cellspacing="0">
																<tbody>
																	<tr>
																		<td></td>
																		<td align="right" style="padding-right:7px;width:100%;">
																			<form action="?subtopic=accountmanagement&action=createcharacter" method="post" style="padding:0px;margin:0px;">
																				<input type="hidden" name="selectedcharacter" value="Draz Mytos">
																				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
																					<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);"></div>
																						<input class="ButtonText" type="image" name="Create Character" alt="Create Character" src="' . $layout_name . '/images/global/buttons/_sbutton_createcharacter.gif">
																					</div>
																				</div>
																			</form>
																		</td>
																	</tr>
																</tbody>
															</table>
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
				</div>
				<br>';
$main_content .= '
				<script>
					EnablePlayButton();
				</script>';
//MIGRATION TOOL ;D
$main_content .= '
					<div class="SmallBox">
						<div class="MessageContainer">
							<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);"></div>
							<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
							<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
							<div class="Message">
								<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></div>
								<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></div>
								<table class="HintBox">
									<tbody>
										<tr>
											<td>
												<p><b>New Account Management</b></p>
												<p>This is the main page of managing your account, here you will have the key to your account information displayed and updated, enjoy! </p>
											</td>
										</tr>
										<tr></tr>
									</tbody>
								</table>
							</div>
							<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);"></div>
							<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
							<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
						</div>
					</div>
					<br>';
