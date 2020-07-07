<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:15
 */

if (!isset($_REQUEST['step'])) {
	$characterName = trim(stripslashes($_REQUEST['name']));
	$playerComment = new Player();
	$playerComment->find($characterName);
	if ($playerComment->isLoaded()) {
		$playerName = $playerComment->getName();
		$playerAcc = new Account();
		$playerAcc->loadByName($_SESSION['account']);
		if ($playerComment->data['account_id'] == $playerAcc->data['id']) {
			//        var_dump($playerComment->data['account_id'], $playerAcc->data['id']);


			$main_content .= '
			Here you can see and edit the information about your character.<br/>
			If you do not want to specify a certain field, just leave it blank.<br/>
			<br/>
			<div class="TableContainer" >
				<table class="Table5" cellpadding="0" cellspacing="0" >
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" >
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<div class="Text" >Character Data</div>
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
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%" >
														<tr>
															<td class="LabelV" style="vertical-align:middle;" >Name:</td>
															<td style="width:80%;" >' . $playerName . '</td>
														</tr>
														<tr>
															<td class="LabelV" style="vertical-align:middle;" >Sex:</td>
															<td>' . htmlspecialchars((($playerComment->getSex() == 0) ? 'female' : 'male')) . '</td>
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
								</td>
							</tr>
						</table>
					</div>
				</table>
			</div>
		</td>
	</tr>
	<br/>
	<br/>';
			$main_content .= '
			<div class="TableContainer" >
				<table class="Table5" cellpadding="0" cellspacing="0" >
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" >
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<div class="Text" >Edit Character Information</div>
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
								<form action="?subtopic=accountmanagement&action=changecharacterinformation&step=change" method="post" >
									<tr>
										<td>
											<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%" >
														<tr>
															<td class="LabelV" >Hide Account:</td>
															<td style="width:80%;" ><input type="checkbox" name="accountvisible" ' . (($playerComment->isHidden()) ? "checked=checked" : "") . '  value="1" />
																check to hide your account information</td>
														</tr>
														<tr>
															<td class="LabelV" ><span >Comment:</span></td>
															<td style="width:80%;" ><textarea name="comment" rows="10" cols="50" wrap="virtual" >' . $playerComment->getComment() . '</textarea></td>
														</tr>
														<tr>
															<td class="LabelV" style="white-space:normal;" ><span >Forum Signature:</span></td>
															<td style="width:80%;" ><textarea name="signature" rows="4" cols="50" wrap="virtual" >' . $playerComment->getSignature() . '</textarea></td>
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
										<td><table style="width:100%" >
											<tr align="center" >
												<td><table border="0" cellspacing="0" cellpadding="0" >
													<tr>
														<td style="border:0px;" ><input type="hidden" name=name value="' . htmlspecialchars($playerName) . '" >
															<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																	<input class="ButtonText" type="image" name="Submit" alt="Submit" src="' . $layout_name . '/images/global/buttons/_sbutton_submit.gif" >
																</div>
															</div>
														</td>
													<tr>
												</form>
											</table>
										</td>
										<td><table border="0" cellspacing="0" cellpadding="0" >
												<form action="?subtopic=accountmanagement" method="post" >
													<tr>
														<td style="border:0px;" >
															<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
																<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																	<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
																</div>
															</div></td>
														</tr>
													</form>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</table>
			</div>
		</td>
	</tr>';
		} else {
			$main_content .= '
			   <center>
			   Você não tem permissão para fazer isso.<br><br>
			   <table border="0" cellspacing="0" cellpadding="0">
								<tbody>
								<tr>
									<td style="border:0px;">
										<div class="BigButton" style="background-image:url(./layouts/tibiacom/images/global/buttons/sbutton.gif)">
											<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
												<div class="BigButtonOver" style="background-image:url(./layouts/tibiacom/images/global/buttons/sbutton_over.gif);"></div>
												<a href="./?subtopic=accountmanagement">
												<input class="ButtonText" type="image" name="Back" alt="Back" src="./layouts/tibiacom/images/global/buttons/_sbutton_back.gif">
												</a>
											</div>
										</div>
									</td>
								</tr>
							
						</tbody></table>
					</center>
			   ';
		}
	} else {
		$main_content .= '
			   <center>
			   Esse personagem não existe.<br><br>
			   <table border="0" cellspacing="0" cellpadding="0">
								<tbody>
								<tr>
									<td style="border:0px;">
										<div class="BigButton" style="background-image:url(./layouts/tibiacom/images/global/buttons/sbutton.gif)">
											<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
												<div class="BigButtonOver" style="background-image:url(./layouts/tibiacom/images/global/buttons/sbutton_over.gif);"></div>
												<a href="./?subtopic=accountmanagement">
												<input class="ButtonText" type="image" name="Back" alt="Back" src="./layouts/tibiacom/images/global/buttons/_sbutton_back.gif">
												</a>
											</div>
										</div>
									</td>
								</tr>
							
						</tbody></table>
					</center>
			   ';
	}
}
if ($_REQUEST['step'] == "change") {
	$characterName = trim(stripslashes($_POST['name']));
	$charChangeInfo = new Player();
	$charChangeInfo->find($characterName);
	if ($charChangeInfo->isLoaded()) {
		$comment = trim(stripslashes($_POST['comment']));
		$signature = trim(stripslashes($_POST['signature']));
		$hidden = (int) $_POST['accountvisible'];
		$charChangeInfo->setComment($comment);
		$charChangeInfo->setSignature($signature);
		$charChangeInfo->setHidden($hidden);
		$charChangeInfo->save();
		$main_content .= '
					<div class="TableContainer" >
						<table class="Table1" cellpadding="0" cellspacing="0" >
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" >
									<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Character Information Changed</div>
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
												<td>The character information has been changed.</td>
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
										</div>
									</td>
								</tr>
							</form>
						</table>
					</center>';
	}
}
