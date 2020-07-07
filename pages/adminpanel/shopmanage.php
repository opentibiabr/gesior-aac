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
if (isset($_REQUEST['serviceId']))
	$serviceId = $_REQUEST['serviceId'];
else header("Location: ?subtopic=adminpanel");

if ($serviceId == 2) {
	$main_content .= '
					<center>
						<table>
							<tbody>
								<tr>
									<td><img src="' . $layout_name . '/images/global/content/headline-bracer-left.gif"></td>
									<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Managing Extra Services</td>
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
							<div class="Text">Extra Services</div>
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
																	<td class="LabelV">Name</td>
																	<td class="LabelV">Price</td>
																	<td class="LabelV">Status</td>
																	<td class="LabelV"> </td>
																</tr>';
	$getExtraServices = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `category` = '$serviceId' ORDER BY `offer_name` ASC")->fetchAll();
	$offer_number = 0;
	foreach ($getExtraServices as $g_extra) {
		if ($g_extra['offer_type'] != "changesex")
			$main_content .= '
																	<tr bgcolor="' . $config['site']['lightborder'] . '">
																		<td width="46%">' . $g_extra['offer_name'] . '</td>
																		<td>
																			<input type="number" name="extraValue" value="' . $g_extra['coins'] . '" ' . (($g_extra['hide'] == 1) ? 'disabled' : '') . '>
																			<input type="submit" name="extraUpdate" id="extraUpdate" value="Update" ' . (($g_extra['hide'] == 1) ? 'disabled' : '') . '>
																			<input type="hidden" name="offerID" value="' . $g_extra['id'] . '">
																		</td>
																		<td class="settingStatus">' . (($g_extra['hide'] == 0) ? '<font style="color:green;">Enabled</font>' : '<font style="color:red;">Disabled</font>') . '</td>
																		<td><a href="#" id="extraStatus">' . (($g_extra['hide'] == 0) ? 'Disable' : 'Enable') . '</a></td>
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
								</td>
							</tr>
						</tbody>
					</table>
				</div><br>
				<div class="msgStatus" style="color:green; padding: 5px; background:#c2f4b2; border:1px solid #165303; display:none;"></div><br>
				<center>
					<form method="post" action="?subtopic=adminpanel">
						<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
							<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
								<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
							</div>
						</div>
					</form>
				</center><br>';
}
if ($serviceId == 3) {
	$main_content .= '
					<center>
						<table>
							<tbody>
								<tr>
									<td><img src="' . $layout_name . '/images/global/content/headline-bracer-left.gif"></td>
									<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Manage your Mounts Sales</td>
									<td><img src="' . $layout_name . '/images/global/content/headline-bracer-right.gif"></td>
								</tr>
							</tbody>
						</table>
					</center>
					<br>';

	$main_content .= '
					<div class="mountStatusSuccess" style="text-align:center;color:green; padding: 5px; background:#c2f4b2; border:1px solid #165303;margin-bottom:15px;display:none;"></div>
					<div class="mountStatusError" style="text-align:center;color:red; padding: 5px; background:#e59d9d; border:1px solid red;margin-bottom:15px;display:none;"></div>
					<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer"> 
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Adding New Mount</div>
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
																	<tr style="background-color:#D4C0A1;" >
																		<td class="LabelV">Select Mount</td>
																		<td class="LabelV">Coins</td>
																	</tr>
																	<tr style="background-color:' . $config['site']['lightborder'] . ';" >
																		<td>
																			<select name="selectMount">
																				<option value="">Select an Mount</option>';
	$mountsList = simplexml_load_file($config['site']['serverPath'] . '/data/XML/mounts.xml');
	foreach ($mountsList->mount as $mlist)
		$main_content .= '
																				<option value="' . $mlist['id'] . ',' . $mlist['name'] . '">' . $mlist['name'] . '</option>';
	$main_content .= '
																			</select>
																		</td>
																		<td><input type="number" name="mountPrice"></td>
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
													<td>
													<center>
													<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
														<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
															<input id="mountSubmit" class="ButtonText" type="image" name="mountSubmit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" >
														</div>
													</div>
													</center>
													</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div><br>
					<center>
						<form method="post" action="?subtopic=adminpanel">
							<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
								</div>
							</div>
						</form>
					</center><br>';
	$main_content .= '
					<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer"> 
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Mounts list sale</div>
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
																	<tr style="background-color:#D4C0A1;" >
																		<td class="LabelV">*</td>
																		<td class="LabelV">Mount Name</td>
																		<td class="LabelV">Price</td>
																		<td class="LabelV">*</td>
																	</tr>';
	$get_Mounts = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `category` = '$serviceId' ORDER BY `offer_date` DESC")->fetchAll();
	$mount_number = 0;
	foreach ($get_Mounts as $g_mount) {
		$bgcolor = (($mount_number++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																	<tr style="background-color:' . $bgcolor . ';">
																		<td width="64px"><img src="' . $layout_name . '/images/shop/mounts/' . str_replace(" ", "_", $g_mount['offer_name']) . '.gif"</td>
																		<td>' . $g_mount['offer_name'] . '</td>
																		<td>' . $g_mount['coins'] . ' Coins</td>
																		<td width="135px">
																			<form id="delMount" method="post" style="padding:0px;margin:0px;" >
																				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
																					<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
																						<input type="hidden" class="delMountId" name="delMountId" value="' . $g_mount['id'] . '">
																						<input class="ButtonText delOutfit" type="image" name="Delete" alt="Delete" src="' . $layout_name . '/images/global/buttons/_sbutton_delete.gif" >
																					</div>
																				</div>
																			</form>
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
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
}
if ($serviceId == 4) {
	$main_content .= '
					<center>
						<table>
							<tbody>
								<tr>
									<td><img src="' . $layout_name . '/images/global/content/headline-bracer-left.gif"></td>
									<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Manage your Outfit Sales</td>
									<td><img src="' . $layout_name . '/images/global/content/headline-bracer-right.gif"></td>
								</tr>
							</tbody>
						</table>
					</center>
					<br>';
	$main_content .= '
					<div class="msgStatusSuccess" style="text-align:center;color:green; padding: 5px; background:#c2f4b2; border:1px solid #165303;margin-bottom:15px;display:none;">Success !</div>
					<div class="msgStatusError" style="text-align:center;color:red; padding: 5px; background:#e59d9d; border:1px solid red;margin-bottom:15px;display:none;">Error !</div>
					<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer"> 
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Adding New Outfit</div>
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
																	<tr style="background-color:#D4C0A1;" >
																		<td class="LabelV">Select Outfit</td>
																		<td class="LabelV">Coins</td>
																	</tr>
																	<tr style="background-color:' . $config['site']['lightborder'] . ';" >
																		<td>
																			<select name="selectOutfit">
																				<option value="">Select an Outfit</option>';
	$outfitsList = simplexml_load_file($config['site']['serverPath'] . '/data/XML/outfits.xml');
	foreach ($outfitsList->outfit as $olist) {
		if ($olist['type'] == 0)
			$main_content .= '
																				<option value="' . $olist['name'] . '">' . $olist['name'] . '</option>';
	}
	$main_content .= '
																			</select>
																		</td>
																		<td><input type="number" name="outfitPrice"></td>
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
													<td>
													<center>
													<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
														<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
															<input id="outfitSubmit" class="ButtonText" type="image" name="outfitSubmit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" >
														</div>
													</div>
													</center>
													</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div><br>
					<center>
						<form method="post" action="?subtopic=adminpanel">
							<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
								</div>
							</div>
						</form>
					</center><br>';
	$main_content .= '
					<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer"> 
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Outfits list sale</div>
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
																	<tr style="background-color:#D4C0A1;" >
																		<td class="LabelV">*</td>
																		<td class="LabelV">Ouftit Name</td>
																		<td class="LabelV">Price</td>
																		<td class="LabelV">*</td>
																	</tr>';
	$get_Outfits = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `category` = '$serviceId' ORDER BY `offer_date` DESC")->fetchAll();
	$outfit_number = 0;
	foreach ($get_Outfits as $g_out) {
		$bgcolor = (($outfit_number++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																	<tr style="background-color:' . $bgcolor . ';" >
																		<td width="64px"><img src="' . $layout_name . '/images/shop/outfits/' . strtolower(str_replace(" ", "_", $g_out['addon_name'])) . '_male.gif"</td>
																		<td>' . $g_out['addon_name'] . '</td>
																		<td>' . $g_out['coins'] . ' Coins</td>
																		<td width="135px">
																			<form id="delOutfit" method="post" style="padding:0px;margin:0px;" >
																				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
																					<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
																						<input type="hidden" class="delOutfitId" name="delOutfitId" value="' . $g_out['id'] . '">
																						<input class="ButtonText delOutfit" type="image" name="Delete" alt="Delete" src="' . $layout_name . '/images/global/buttons/_sbutton_delete.gif" >
																					</div>
																				</div>
																			</form>
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
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
}
if ($serviceId == 5) {
	$main_content .= '
					<center>
						<table>
							<tbody>
								<tr>
									<td><img src="' . $layout_name . '/images/global/content/headline-bracer-left.gif"></td>
									<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Manage your Items Sales</td>
									<td><img src="' . $layout_name . '/images/global/content/headline-bracer-right.gif"></td>
								</tr>
							</tbody>
						</table>
					</center>
					<br>';

	$main_content .= '
					<div class="msgStatusSuccess" style="text-align:center;color:green; padding: 5px; background:#c2f4b2; border:1px solid #165303;margin-bottom:15px;display:none;"></div>
					<div class="msgStatusError" style="text-align:center;color:red; padding: 5px; background:#e59d9d; border:1px solid red;margin-bottom:15px;display:none;"></div>
					<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer"> 
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Adding New Item</div>
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
																	<tr style="background-color:#D4C0A1;" >
																		<td class="LabelV">Item ID</td>
																		<td class="LabelV">Item Name</td>
																		<td class="LabelV">Item Description</td>
																		<td class="LabelV">Amount</td>
																		<td class="LabelV">Coins</td>
																	</tr>
																	<tr bgcolor="' . $config['site']['lightborder'] . '">
																		<td><input type="number" name="itemID" placeholder="Item Id"></td>
																		<td><input type="text" name="itemName" placeholder="Item Name"></td>
																		<td><input type="text" name="itemDesc" placeholder="Item Name" maxlenght="255"></td>
																		<td><input type="number" name="itemAmount" placeholder="Amount"></td>
																		<td><input type="number" name="itemPrice" placeholder="Item Price"></td>
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
													<td>
													<center>
													<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
														<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
															<input id="itemSubmit" class="ButtonText" type="image" name="itemSubmit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" >
														</div>
													</div>
													</center>
													</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div><br>
					<center>
						<form method="post" action="?subtopic=adminpanel">
							<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
								</div>
							</div>
						</form>
					</center><br>';

	$main_content .= '
					<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer"> 
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Items list sale</div>
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
																	<tr style="background-color:#D4C0A1;" >
																		<td class="LabelV">Item ID</td>
																		<td class="LabelV">Item Name</td>
																		<td class="LabelV">Item Description</td>
																		<td class="LabelV">Price</td>
																	</tr>';
	$get_Items = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `category` = '$serviceId' ORDER BY `offer_date` DESC")->fetchAll();
	$item_number = 0;
	foreach ($get_Items as $g_item) {
		$bgcolor = (($item_number++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																	<tr style="background-color:' . $bgcolor . ';" >
																		<td width="32px">
																		<img src="' . $layout_name . '/images/shop/items/' . strtolower($g_item['itemid']) . '.gif"</td>
																		<td>' . $g_item['itemid'] . '</td>
																		<td>' . $g_item['offer_name'] . '</td>
																		<td>' . ((!empty($g_item['offer_description'])) ? $g_item['offer_description'] : 'No description') . '</td>
																		<td>' . $g_item['coins'] . ' Coins</td>
																		<td width="135px">
																			<form id="delItem" method="post" style="padding:0px;margin:0px;" >
																				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
																					<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
																						<input type="hidden" class="delItemId" name="delItemId" value="' . $g_item['id'] . '">
																						<input class="ButtonText delItem" type="image" name="Delete" alt="Delete" src="' . $layout_name . '/images/global/buttons/_sbutton_delete.gif" >
																					</div>
																				</div>
																			</form>
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
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
}
if ($serviceId == 6) {
	$main_content .= '
					<center>
						<table>
							<tbody>
								<tr>
									<td><img src="' . $layout_name . '/images/global/content/headline-bracer-left.gif"></td>
									<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Manage your tibia coins packages</td>
									<td><img src="' . $layout_name . '/images/global/content/headline-bracer-right.gif"></td>
								</tr>
							</tbody>
						</table>
					</center>
					<br>';
	$main_content .= '<p>You must add a package of tibia coins for your player can buy products in your shop.</p>';
	$main_content .= '
					<div class="msgStatusSuccess" style="text-align:center;color:green; padding: 5px; background:#c2f4b2; border:1px solid #165303;margin-bottom:15px;display:none;"></div>
					<div class="msgStatusError" style="text-align:center;color:red; padding: 5px; background:#e59d9d; border:1px solid red;margin-bottom:15px;display:none;"></div>
					<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer"> 
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Adding new package of tibia coins</div>
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
																	<tr style="background-color:#D4C0A1;" >
																		<td class="LabelV">Amount of coins</td>
																		<td class="LabelV">Price (R$)</td>
																		<td class="LabelV">Description</td>
																	</tr>
																	<tr bgcolor="' . $config['site']['lightborder'] . '">
																		<td><input type="number" name="pointsAmount" placeholder="Amount of coins"></td>
																		<td><input id="campoMoney" type="text" name="pointsPrice" placeholder="Price Ex. 10.00"></td>
																		<td><input type="text" name="pointsDesc" placeholder="Coins short description" maxlenght="255"></td>
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
													<td>
													<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
														<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
															<input id="pointsSubmit" class="ButtonText" type="image" name="pointsSubmit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" >
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
					<center>
						<form method="post" action="?subtopic=adminpanel">
							<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
								</div>
							</div>
						</form>
					</center><br>';
	$main_content .= '
					<div class="TableContainer">
						<div class="CaptionContainer">
							<div class="CaptionInnerContainer"> 
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">Tibia Coins list sale</div>
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
																	<tr style="background-color:#D4C0A1;" >
																		<td class="LabelV">Amount of Coins</td>
																		<td class="LabelV">Price</td>
																		<td class="LabelV">Description</td>
																		<td class="LabelV">*</td>
																	</tr>';
	$get_Points = $SQL->query("SELECT * FROM `z_shop_offer` WHERE `category` = '$serviceId' ORDER BY `offer_date` DESC")->fetchAll();
	$points_number = 0;
	foreach ($get_Points as $g_point) {
		$bgcolor = (($points_number++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
		$main_content .= '
																	<tr style="background-color:' . $bgcolor . ';" >
																		<td>' . $g_point['count'] . ' Coins</td>
																		<td>R$ ' . number_format($g_point['price'], 2, ',', '.') . '</td>
																		<td>' . ((!empty($g_point['offer_description'])) ? $g_point['offer_description'] : 'No description') . '</td>
																		<td width="135px">
																			<form id="delPoint" method="post" style="padding:0px;margin:0px;" >
																				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
																					<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
																						<input type="hidden" class="delPointId" name="delPointId" value="' . $g_point['id'] . '">
																						<input class="ButtonText delPoint" type="image" name="Delete" alt="Delete" src="' . $layout_name . '/images/global/buttons/_sbutton_delete.gif" >
																					</div>
																				</div>
																			</form>

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
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
}
