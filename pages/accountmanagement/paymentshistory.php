<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:12
 */


$account_name = $account_logged->getName();
$get_payments = $SQL->query("SELECT * FROM `z_shop_donates` WHERE `account_name` = '$account_name' ORDER BY `date` DESC")->fetchAll();

$main_content .= '
			<div class="TableContainer" >
				<table class="Table2" cellpadding="0" cellspacing="0">
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" >
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<div class="Text" >Payment History</div>
							<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						</div>
					</div>
					<tr>
						<td><div class="InnerTableContainer" >
								<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
									<tr class="LabelH" >
										<td>Date</td>
										<td>Method</td>
										<td>Price</td>
										<td>Status</td>
										<td>Action</td>
									</tr>';
if (count($get_payments) > 0) {
	foreach ($get_payments as $payments) {
		$main_content .= '
											<tr bgcolor="' . $config['site']['darkborder'] . '">
												<td>' . date("M d Y, H:i:s", $payments['date']) . '</td>
												<td>' . $payments['method'] . '</td>
												<td>R$ ' . number_format($payments['price'], '2', ',', '.') . '</td>
												<td>' . $payments['status'] . '</td>
												<td>' . (($payments['status'] == "confirm") ? '[<a style="white-space: nowrap" href="?subtopic=accountmanagement&action=confirmdonate&orderID=' . $payments['id'] . '" >Confirm</a>]<br/>' : '') . '</td>';
		$main_content .= '
											</tr>';
	}
} else {
	$main_content .= '
										<tr bgcolor="#F1E0C6" >
											<td colspan="6" >No entries yet.</td>
										</tr>';
}
$main_content .= '
								</table>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<table style="width:100%;" >
				<tr align="center" >
					<td>
						<form action="?subtopic=accountmanagement&action=manage" method="post" style="padding:0px;margin:0px;" >
							<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
								</div>
							</div>
						</form>
					</td>
				</tr>
			</table>';
