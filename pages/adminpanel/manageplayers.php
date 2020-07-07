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
								<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">Manage Players</td>
								<td><img src="' . $layout_name . '/images/global/content/headline-bracer-right.gif"></td>
							</tr>
						</tbody>
					</table>
				</center>
				<br>';

if (!isset($_REQUEST['playerview'])) {
	$main_content .= '
					<form action="" method="post">
						<table width="100%" border="0" cellspacing="1" cellpadding="4">
							<tr>
								<td bgcolor="#505050" class="white"><b>Search Character</b></td>
							</tr>
							<tr>
								<td bgcolor="#D4C0A1">
									<table border="0" cellpading="1">
										<TR>
											<td>Name:</td>
											<td><input name="playerview" value="' . $_REQUEST['playerview'] . '" size="29" maxlenght="29"></td>
											<td><input type="image" name="Submit" src="' . $layout_name . '/images/global/buttons/sbutton_submit.gif" border="0" width="120" height="18"></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</form>';
} else {
	$player_name = trim($_REQUEST['playerview']);
	$player = new Player();
	$player->find($player_name);
	if (!$player->isLoaded()) {
		$main_content .= '
							<div class="TableContainer" >
								<table class="Table1" cellpadding="0" cellspacing="0" >
									<div class="CaptionContainer" >
										<div class="CaptionInnerContainer" > 
											<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<div class="Text" >Player Page Error</div>
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
														<td>The character with name ' . $player_name . ' doesn\'t exist. Please try again.</td>
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
											<form action="?subtopic=adminpanel&action=manageplayers" method="post">
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
		$main_content .= '
							<div class="TableContainer" >
								<table class="Table5" cellpadding="0" cellspacing="0">
									<div class="CaptionContainer" >
										<div class="CaptionInnerContainer" > 
											<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
											<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
											<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
											<div class="Text" >' . $player->getName() . '</div>
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
																	<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																		<tr>
																			<td class="LabelV">Add Coins</td>
																			<td>
																				<input type="number" name="addPoints">
																				<input type="hidden" name="accountPoints" value="' . $player->getAccount()->getName() . '">
																				<button type="submit" id="addP" name="addP">Add</button>
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
								</table>
							</div>
							<TABLE width="100%">
								<tr align="center">
									<td>
										<form action="?subtopic=adminpanel&action=manageplayers" method="post" style="padding:0px;margin:0px;" >
											<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
												<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
													<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
												</div>
											</div>
										</form>
									</td>
								</tr>
							</TABLE>';
	}
}
