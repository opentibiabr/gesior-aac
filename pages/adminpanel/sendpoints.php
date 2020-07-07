<?php

/**
 *
 * @package        uam.skeleton
 * @subpackage     controllers
 * @author         Codenome Developpers - Main Developer: Ricardo <http://codenome.com>
 * @copyright      Copyright (c) 2018, Codenome. (http://myara.net/)
 * @license        GPL v3
 * @link           http://uam.codenome.com
 * @since          Version 0.0.1
 * @filesource
 */

if (!isset($_REQUEST['orderID']))
	$points_errors[] = "You must enter the order ID.";
if (!empty($points_errors)) {
	$main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
										<div class="Text" >Send Points Errors</div>
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
	foreach ($points_errors as $p_error)
		$main_content .= $p_error . '<br>';
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
										<form action="?subtopic=adminpanel&action=history" method="post">
											<input type="hidden" name="ServiceCategoryID" value="' . $serviceCategoryID . '" />
											<input type="hidden" name="step" value="1">
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

	if ($_REQUEST['confirm'] == "yes") {

		$orderID = $_REQUEST['orderID'];
		$orderAccount = $_REQUEST['orderAccName'];
		$doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
		if ($doubleStatus['value'] == "active")
			$orderPoints = 2 * $_REQUEST['orderPoints'];
		else
			$orderPoints = $_REQUEST['orderPoints'];
		$loyaltyPoints = $_REQUEST['orderPoints'];
		$account_points = new Account();
		$account_points->loadByName($orderAccount);

		$account_points->setPremiumPoints($account_points->getPremiumPoints() + $orderPoints);
		$account_points->setLoyalty($account_points->getLoyalty() + $loyaltyPoints);
		$account_points->save();

		$update_order = $SQL->query("UPDATE `z_shop_donates` SET `status` = 'received' WHERE `id` = '$orderID' AND `account_name` = '" . $account_points->getName() . "'");

		$main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
										<div class="Text" >Points Sent</div>
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
													<td>You sent <strong>' . $orderPoints . '</strong> points to account <strong>' . $orderAccount . '</strong>.</td>
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
										<form action="?subtopic=adminpanel&action=history" method="post">
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
	} elseif ($_REQUEST['confirm'] == "no") {
		$orderID = $_REQUEST['orderID'];
		$orderAccount = $_REQUEST['orderAccName'];

		$update_order = $SQL->query("UPDATE `z_shop_donates` SET `status` = 'rejected' WHERE `id` = '$orderID' AND `account_name` = '$orderAccount'");

		$main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
										<div class="Text" >Confirmation Rejected</div>
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
													<td>You have rejected this confirmation succefully.</td>
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
										<form action="?subtopic=adminpanel&action=history" method="post">
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
		$orderID = $_REQUEST['orderID'];
		$getpayInfo = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `id` = '$orderID'")->fetch();
		$getorderInfo = $SQL->query("SELECT * FROM `z_shop_donate_confirm` WHERE `donate_id` = '$orderID'")->fetch();
		$doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
		$main_content .= '
						<div class="TableContainer">
							<div class="CaptionContainer">
								<div class="CaptionInnerContainer">
									<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
									<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
									<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
									<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
									<div class="Text">Donate Confirmation</div>
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
											<div class="InnerTableContainer" >
												<table style="width:100%;" >
													<tr>
														<td>
															<div class="TableShadowContainerRightTop" >
																<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
															</div>
															<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
																<div class="TableContentContainer" >
																	<table class="TableContent" width="100%">
																		<tr bgcolor="' . $config['site']['darkborder'] . '">
																			<td class="LabelV" width="50%">Donate Method</td>
																			<td>' . $getpayInfo['method'] . '</td>
																		</tr>
																		<tr bgcolor="' . $config['site']['lightborder'] . '">
																			<td class="LabelV">Buyer\'s Account Name</td>
																			<td>' . $getpayInfo['account_name'] . '</td>
																		</tr>
																		<tr bgcolor="' . $config['site']['darkborder'] . '">
																			<td class="LabelV">Confirmation Text</td>
																			<td>"<i>' . $getorderInfo['msg'] . '</i>"</td>
																		</tr>
																		<tr bgcolor="' . $config['site']['lightborder'] . '">
																			<td class="LabelV">Send ' . (($doubleStatus['value'] == "active") ? (2 * $getpayInfo['coins']) : $getpayInfo['coins']) . ' coins to account ' . $getpayInfo['account_name'] . ' ?</td>
																			<td>
																				<table border="0" cellspacing="0" cellpadding="0" >
																					<form action="?subtopic=adminpanel&action=sendPoints" method="post">
																						<input type="hidden" name="orderID" value="' . $orderID . '">
																						<input type="hidden" name="orderAccName" value="' . $getpayInfo['account_name'] . '">
																						<input type="hidden" name="orderPoints" value="' . $getpayInfo['coins'] . '">
																						<input type="hidden" name="confirm" value="yes">
																						<tr>
																							<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
																								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
																										<input class="ButtonText" type="image" name="Confirm" alt="Confirm" src="' . $layout_name . '/images/global/buttons/_sbutton_confirm.gif" >
																									</div>
																								</div>
																							</td>
																						</tr>
																					</form>
																				</table>
																				<table border="0" cellspacing="0" cellpadding="0" >
																					<form action="?subtopic=adminpanel&action=sendPoints" method="post">
																						<input type="hidden" name="orderID" value="' . $orderID . '">
																						<input type="hidden" name="orderAccName" value="' . $getpayInfo['account_name'] . '">
																						<input type="hidden" name="confirm" value="no">
																						<tr>
																							<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
																								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
																										<input class="ButtonText" type="image" name="Cancel" alt="Cancel" src="' . $layout_name . '/images/global/buttons/_sbutton_cancel.gif" >
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
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<TABLE BORDER=0 WIDTH=100%>
								<TR>
									<TD ALIGN=center>
										<table border="0" cellspacing="0" cellpadding="0" >
											<form action="?subtopic=adminpanel&action=history" method="post">
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
