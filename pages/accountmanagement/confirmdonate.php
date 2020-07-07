<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:08
 */

$donateID = (int) $_REQUEST['id'];
$getDonate = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `id` = '$donateID'")->fetchAll();

if (count($getDonate[0]) == 0) {
	$main_content .= '
				<div class="TableContainer" >
					<table class="Table1" cellpadding="0" cellspacing="0" >
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" >
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
								<div class="Text" >Send Coins Errors</div>
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
											<td>Sorry, but you do not currently have any pending donation confirmation.</td>
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

	if ($_REQUEST['confirmed'] == "yes") {

		$donateID = (int) $_REQUEST['id'];
		$confirmText = trim($_REQUEST['confirMsg']);
		$donateDate = time();
		$donateAccount = $account_logged->getName();

		if (strlen($confirmText) <= 20)
			$confirm_errors[] = "Your confirmation must have at least 20 characters .";
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
			foreach ($confirm_errors as $c_error)
				$main_content .= $c_error . '<br>';
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
										<form action="?subtopic=accountmanagement&action=confirmdonate" method="post">
											<input type="hidden" name="id" value="' . $donateID . '">
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
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$hash = md5(implode($_POST));
				if (isset($_SESSION['hash']) && $_SESSION['hash'] == $hash) {
					// Refresh! Não faz nada ou re-exibe o formulário preenchido
				} else {
					$_SESSION['hash'] = $request;
					$update_donate_status = $SQL->query("UPDATE `z_shop_donates` SET `status` = 'confirmed' WHERE `id` = '$donateID' AND `account_name` = '$donateAccount'");
					$add_confirmation = $SQL->query("INSERT INTO `z_shop_donate_confirm` (`date`,`account_name`,`donate_id`,`msg`) VALUES ('$donateDate','$donateAccount','$donateID','$confirmText')");
				}
			}
			$main_content .= '
							<div class="TableContainer">
								<div class="CaptionContainer">
									<div class="CaptionInnerContainer">
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
										<div class="Text">Donation confirmed</div>
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
																			<tr>
																				<td>You just confirmed a donation made to our server. Within 24 hours we will be checking your confirmation, then crediting your coins. Thank you very much!</td>
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
													</table>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div><br>
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

		$main_content .= '
				<form method="post" action="?subtopic=accountmanagement&action=confirmdonate">
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer">
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">Confirm your donate</div>
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
																<tr bgcolor="#D4C0A1">
																	<td>
																		<strong>Confirm your donate using textbox</strong><br>
																		<small>(Tell all the data needed for confirmation, such as: Bank, the transaction date, etc.)</small>
																	</td>
																	<td>
																		<textarea name="confirMsg" rows="10" cols="55"></textarea>
																	</td>
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
										</table>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>';

		$main_content .= '
				<div class="SubmitButtonRow" >
					<div class="LeftButton" >
						<input type="hidden" name="confirmed" value="yes" >
						<input type="hidden" name="id" value="' . $donateID . '">
						<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
							<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
								<input class="ButtonText" type="image" name="Next" alt="Next" src="' . $layout_name . '/images/global/buttons/_sbutton_next.gif" >
							</div>
						</div>
					</div>
					</form>
					<div class="RightButton" >
						<form method="post" action="?subtopic=accountmanagement&action=manage" >
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
