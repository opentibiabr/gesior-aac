<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:11
 */

$orderID = (int) $_REQUEST['orderID'];
$transConfirm = $SQL->query("SELECT * FROM `z_shop_payment` WHERE `id` = '$orderID'")->fetch();
if ($transConfirm['status'] != "confirm")
	$confirmErrors[] = "You do not have transfer to be confirmed.";
if (!empty($confirmErrors)) {
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
	foreach ($confirmErrors as $error)
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
} else { //CONFIRMAR TRANSFER
	$confirmmsg = trim($_REQUEST['confirmmsg']);
	if (empty($confirmmsg))
		$confirm_errors[] = "Please enter the data of your bank transfer so that we can confirm.";

	if ($_REQUEST['confirm'] == "yes") {
		if (!empty($confirm_errors)) {
			$main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
										<div class="Text" >Confirmation Errors</div>
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
			foreach ($confirm_errors as $error)
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
										<form action="?subtopic=accountmanagement&action=confirmtransfer" method="post">
											<input type="hidden" name="orderID" value="' . $_REQUEST['orderID'] . '">
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
			$accountName = $account_logged->getName();
			$orderId = $_REQUEST['orderID'];
			$update_order = $SQL->query("UPDATE `z_shop_payment` SET `status` = 'confirmed' WHERE `account_name` = '$accountName' AND `id` = '$orderId'");
			$add_confirmation = $SQL->query("INSERT INTO `z_shop_payment_confirm` (`account_name`,`order_id`,`confirm_msg`,`date`) VALUES ('$accountName','$orderId','$confirmmsg','" . time() . "')");
			$main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
										<div class="Text" >Confirmation Success</div>
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
													<td>Your donation has been successfully confirmed. In 24 hours your coins will be credited </td>
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
	} else {
		$getOrder = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `id` = '" . $transConfirm['service_id'] . "'")->fetch();
		$main_content .= '
							<form method="post" action="?subtopic=accountmanagement&action=confirmtransfer">
							<div class="TableContainer">
								<div class="CaptionContainer">
									<div class="CaptionInnerContainer">
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
										<div class="Text">Confirm your transfer</div>
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
																	<div class="TableContentContainer" >';

		$main_content .= '
																		<table class="TableContent" width="100%">
																			<tr style="background-color:#D4C0A1;" >
																				<td class="LabelV">Confirm your transfer with transfer data:</td>
																				<td style="width:90%;" ><textarea name="confirmmsg" cols="50" rows="8"></textarea></td>
																			</tr>
																			<tr style="background-color:#F1E0C6;" >
																				<td class="LabelV">Product Info</td>
																				<td>' . $getOrder['offer_name'] . ', price: R$ ' . $getOrder['price'] . '</td>
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
														<tr>
															<td>After confirmed your donation our team will be up to 24 hours to credit your tibia coins.</td>
														</tr>
													</table>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="SubmitButtonRow" >
								<div class="LeftButton" >
										<input type="hidden" name="confirm" value="yes">
										<input type="hidden" name="accountID" value="' . $account_logged->getID() . '">
										<input type="hidden" name="orderID" value="' . $orderID . '">
										<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
											<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
												<input class="ButtonText" type="image" name="Next" alt="Next" src="' . $layout_name . '/images/global/buttons/_sbutton_next.gif" >
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
