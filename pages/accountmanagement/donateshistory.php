<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:10
 */

$main_content .= '
						<div class="TableContainer" >
							<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" >
									<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Donates History</div>
									<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;">
																<tr bgcolor="' . $config['site']['darkborder'] . '">';
$getHistoryDonate = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `account_name` = '" . $account_logged->getName() . "' ORDER BY `date` DESC")->fetchAll();
$main_content .= '
																	<td class="LabelV">Date</td>
																	<td class="LabelV">Service</td>
																	<td class="LabelV">Price</td>
																	<td class="LabelV">Method</td>
																	<td class="LabelV">Bank Name</td>
																	<td class="LabelV">Status</td>
																	<td class="LabelV"></td>
																</tr>';
$getPagseguroDonates = $SQL->query("SELECT * FROM `pagseguro_transactions` where `name` = '{$account_logged->getName()}' order by `data` desc")->fetchAll();
if (count($getPagseguroDonates) > 0) {
	$n = 0;
	foreach ($getPagseguroDonates as $pagseguro) {
		$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$date = new DateTime($pagseguro['data']);
		$main_content .= "
					<tr bgcolor='{$bgcolor}'>
						<td>" . $date->format('M d Y') . "</td>
						<td>{$pagseguro['item_count']} Tibia Coins</td>
						<td>" . number_format($pagseguro['payment_amount'], 2, '.', ',') . " BRL</td>
						<td>pagseguro</td>
						<td></td>
						<td>{$pagseguro['status']}</td>
						<td></td>
					</tr>
				";
	}
	$main_content .= "<th/>";
	unset($n);
}
if (count($getHistoryDonate[0]) > 0) {
	$n = 0;
	foreach ($getHistoryDonate as $doHistory) {
		$bgcolor = (($n++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																<tr bgcolor="' . $bgcolor . '">
																	<td>' . date("M d Y", $doHistory['date']) . '</td>
																	<td>' . $doHistory['coins'] . ' Tibia Coins</td>
																	<td>' . $doHistory['price'] . ' BRL</td>
																	<td>' . $doHistory['method'] . '</td>';
		$bankref = explode("-", $doHistory['reference']);
		$bankName = $bankref[1];
		$main_content .= '<td>' . $bankName . '</td>';
		$main_content .= '
																	<td>' . $doHistory['status'] . '</td>
																	<td>' . (($doHistory['status'] == "confirm") ? '[<a href="?subtopic=accountmanagement&action=confirmdonate&id=' . $doHistory['id'] . '">Confirm</a>]' : '') . '</td>
																</tr>';
	}
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
$main_content .= '
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div>
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
