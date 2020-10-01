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

$main_content .= '
				<center>
					<table>
						<tbody>
							<tr>
								<td><img src="' . $layout_name . '/images/global/content/headline-bracer-left.gif"></td>
								<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Admin Panel, welcome ' . $account_logged->getRLName() . '!<br></td>
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
							<div class="Text">General Information</div>
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
$playersCount = $SQL->query("SELECT COUNT(*) FROM `players`")->fetch();
$accountsCount = $SQL->query("SELECT COUNT(*) FROM `accounts`")->fetch();
$guildsCount = $SQL->query("SELECT COUNT(*) FROM `guilds`")->fetch();
$shopsCount = $SQL->query("SELECT COUNT(*) FROM `z_shop_offer`")->fetch();
$versionCount10 = $SQL->query("SELECT COUNT(*) FROM `players` WHERE `version` <= 1100")->fetch();
$versionCount12 = $SQL->query("SELECT COUNT(*) FROM `players` WHERE `version` > 1100")->fetch();
$main_content .= '
															<table class="TableContent" width="100%">
																<tr style="background-color:#D4C0A1;" >
																	<td class="LabelV" >Accounts on database:</td>
																	<td style="width:90%;" >' . $accountsCount[0] . ' Accounts</td>
																</tr>
																<tr style="background-color:#F1E0C6;" >
																	<td class="LabelV" >Players on database:</td>
																	<td style="width:90%;" >' . $playersCount[0] . ' Players - <a href="./?subtopic=adminpanel&action=manageplayers">Manage Players</a></td>
																</tr>
																<tr style="background-color:#D4C0A1;" >
																	<td class="LabelV" >Guilds on database:</td>
																	<td style="width:90%;" >' . $guildsCount[0] . ' Guilds</td>
																</tr>
																<tr style="background-color:#F1E0C6;" >
																	<td class="LabelV" >Products on shop:</td>
																	<td style="width:90%;" >' . $shopsCount[0] . ' Products</td>
																</tr>
																<tr style="background-color:#D4C0A1;" >
																	<td class="LabelV" >Client Version:</td>
																	<td style="width:90%;" >11.00: ' . number_format(($versionCount10[0] * 100) / ($versionCount10[0] + $versionCount12[0]), 2, '.', '')  . '% (' . $versionCount10[0] . ') <br/ >12.xx: ' . number_format(($versionCount12[0] * 100) / ($versionCount10[0] + $versionCount12[0]), 2, '.', '')  . '% (' . $versionCount12[0] . ')</td>
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
				</div><br>';
$main_content .= '
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span> 
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span> 
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span> 
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">Newsticker</div>
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
																	<td class="LabelV" >The last one:</td>';
$get_ticker = $SQL->query("SELECT * FROM `newsticker` ORDER BY `date` DESC LIMIT 1")->fetchAll();
if (count($get_ticker) > 0)
	foreach ($get_ticker as $ticker)
		$main_content .= '
																			<td style="width:90%;" >
																				<div style="max-width: 600px">
																				<img src="' . $layout_name . '/images/global/content/' . $ticker['icon'] . '_small.gif" style=" vertical-align: middle;"> ' . $ticker['text'] . '
																				<a href="#" id="delTicker">Delete</a>
																				<input type="hidden" name="tickerID" value="' . $ticker['id'] . '"><br />
																				<small><strong>Posted ' . date("M d Y, H:i:s", $ticker['date']) . '</strong></small>
																				</div>
																			</td>';
else
	$main_content .= '<td style="width:90%;" >No tickers added yet</td>';
$main_content .= '
																</tr>
																<tr style="background-color:#F1E0C6;" >
																	<td class="LabelV" >Add one:</td>
																	<td>																		
																		<table class="TableContent" width="100%">
																			<tr>
																				<td width="100%"><input type="text" name="tickerText" style="width:100%;" placeholder="Max lenght 255 characters" maxlenght="255"></td>
																			</tr>
																			<tr>
																				<td width="90%">
																					<select name="tickerIcon" style="width:100%;">
																						<option value="">Select an Icon</option>
																						<option value="newsicon_technical">Technical Icon</option>
																						<option value="newsicon_cipsoft">Staff Icon</option>
																						<option value="newsicon_development">Development Icon</option>
																						<option value="newsicon_community">Community Icon</option>
																					</select>
																				</td>
																				<td><input id="insertTicker" type="submit" name="insert" value="Add Ticker"></td>
																			</tr>
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
				</div><br>';
include 'ticketspanel.php';
$main_content .= '
				<br>
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span> 
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span> 
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span> 
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">Shop System</div>
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
																	<td valign="middle" class="LabelV" width="90%">Double Coins Status</td>';
$doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
$main_content .= '
																	<td>
																		<a href="#" id="doubleStatus"><img src="' . $layout_name . '/images/shop/' . (($doubleStatus['value'] == "active") ? 'on' : 'off') . '.png" width="47px" height="23px" title="Ativo"></a>
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
															<table class="TableContent categoryStatus" width="100%">';

$get_Categories = $SQL->query("SELECT * FROM `z_shop_category` ORDER BY `name` ASC");
$cat_number = 0;
foreach ($get_Categories as $cat) {
	$bgcolor = (($cat_number++ % 2 == 1) ? $config['site']['lightborder'] : $config['site']['darkborder']);
	$main_content .= '
																	<tr bgcolor="' . $bgcolor . '">
																		<td><strong>' . $cat['name'] . '</strong></td>
																		<td width="70%">
																			<a href="#" id="categoryStatus">' . (($cat['hide'] == 0) ? 'Disable' : 'Enable') . '</a>
																			<input type="hidden" class="ServiceId" name="ServiceId" value="' . $cat['id'] . '">
																		</td>
																		<td>
																			<a ' . (($cat['hide'] >= 1) ? 'style="display:none;"' : '') . ' class="manageAction" href="?subtopic=adminpanel&action=shopmanage&serviceId=' . $cat['id'] . '">Manage</a>
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
							<tr>
								<td align="center">
									<form method="post" action="?subtopic=adminpanel&action=history">
										<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
											<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
												<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_viewhistory.gif" >
											</div>
										</div>
									</form>
								</td>
							</tr>
						</tbody>
					</table>
				</div><br>
					<center>
						<form method="post" action="?subtopic=accountmanagement">
							<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
								</div>
							</div>
						</form>
					</center>';
