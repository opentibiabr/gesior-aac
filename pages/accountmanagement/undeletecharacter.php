<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:17
 */

if (!isset($_REQUEST['step'])) {
	$charName = trim(stripslashes($_REQUEST['name']));
	$main_content .= '
				To undelete this character click on "Submit".<br/>
				Note that characters can only be restored within the first 2 months (60 days) after the deletion.<br/>
				<br/>
				<form action="?subtopic=accountmanagement&action=undeletecharacter&step=undeletecharacter" method="post" >
					<div class="TableContainer" >
						<table class="Table1" cellpadding="0" cellspacing="0" >
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" >
									<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Undelete Character</div>
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
												<td class="LabelV" ><span >Character Name:</span></td>
												<td style="width:90%;" >' . $charName . '</td>
											</tr>
										</table>
									</div>
								</table>
							</div>
						</td>
					</tr>
					<br/>
					<table style="width:100%" >
					<tr align="center" >
						<td><table border="0" cellspacing="0" cellpadding="0" >
							<tr>
								<td style="border:0px;" ><input type="hidden" name=name value="' . $charName . '" >
									<input type="hidden" name=selectedcharacter value="' . $charName . '" >
									<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" >
											<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
											<input class="ButtonText" type="image" name="Submit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" >
										</div>
									</div>
								</td>
							<tr>
						</form>
					</table>
				</td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0" >
						<form action="?subtopic=accountmanagement" method="post" >
							<tr>
								<td style="border:0px;" >
									<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" >
											<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
											<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
										</div>
									</div>
								</td>
							</tr>
						</form>
					</table>
				</td>
			</tr>
		</table>';
}
if ($_REQUEST['step'] == "undeletecharacter") {
	$charName = htmlspecialchars($_REQUEST['name']);
	$undeleteChar = new Player();
	$undeleteChar->find($charName);
	if ($undeleteChar->isLoaded()) {
		$undeleteChar->setDeletion(0);
		$undeleteChar->setDeleted(0);
		$undeleteChar->save();
	}

	$main_content .= '
				<div class="TableContainer" >
					<table class="Table1" cellpadding="0" cellspacing="0" >
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" >
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
								<div class="Text" >Character Undeleted</div>
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
											<td>The character <b>' . $charName . '</b> has been undeleted.</td>
										</tr>
									</table>
								</div>
							</table>
						</div>
					</td>
				</tr>
				<br>
				<center>
					<table border="0" cellspacing="0" cellpadding="0" >
						<form action="?subtopic=accountmanagement" method="post" >
							<tr>
								<td style="border:0px;" >
									<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" >
											<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
											<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
										</div>
									</div></td>
							</tr>
						</form>
					</table>
				</center>';
}
