<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:20
 */

if (!isset($_REQUEST['step'])) {
	$charName = trim(stripslashes($_REQUEST['name']));
	$delChar = new Player();
	$delChar->find($charName);
	if ($delChar->isLoaded()) {
		$delPlayerName = $delChar->getName();
		$delPlayerAcc = new Account();
		$delPlayerAcc->loadByName($_SESSION['account']);
		if ($delChar->data['account_id'] == $delPlayerAcc->data['id']) {


			if (isset($_REQUEST['function']) && $_REQUEST['function'] == "deletecharacter") {
				$spanColor = "";
				$delPassword = trim(stripslashes($_POST['password']));
				if (!$account_logged->isValidPassword($delPassword)) {
					$erro = "Password is not correct!";
					$spanColor = "class=red";
				}
				if (empty($erro)) {
					$delChar->setDeleted(1);
					$delChar->setDeletion(time() + ($config['site']['daystodelete'] * 86400));
					$delChar->save();
					header("Location: ?subtopic=accountmanagement&action=deletecharacter&step=deletecharacter&name=$charName");
				} else {
					$main_content .= '
							<div class="SmallBox" >
								<div class="MessageContainer" >
									<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
									<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
									<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
									<div class="ErrorMessage" >
										<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
										<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></div>
										<div class="AttentionSign" style="background-image:url(' . $layout_name . '/images/global/content/attentionsign.gif);" /></div>
										<b>The following error has occurred:</b><br/>
										' . $erro . '
									</div>
									<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
									<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
									<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
								</div>
							</div>
							<br/>';
				}
			}
			$main_content .= '
					To delete this character enter your password and click on "Submit".<br/>
					You can undelete the character within the first 7 days after the deletion.<br/>
					After this time the character is deleted for good and cannot be restored anymore!<br/>
					<br/>
					<form action="?subtopic=accountmanagement&action=deletecharacter&name=' . $charName . '" method="post" >
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
										<div class="Text">Delete Character</div>
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
													<td class="LabelV" ><span >Character Name:</td>
													<td style="width:90%;" >' . htmlspecialchars($delChar->getName()) . '</td>
												</tr>
												<tr>
													<td class="LabelV" ><span ' . $spanColor . '>Password:</td>
													<td><input type="password" name="password" size="30" maxlength="29" ></td>
												</tr>';
			if (!empty($erro))
				$main_content .= '
												<tr>
													<td></td>
													<td><span class="FormFieldError">' . $erro . '</span></td>
												</tr>';
			$main_content .= '
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
									<td style="border:0px;" >
										<input type="hidden" name=function value="deletecharacter" >
										<input type="hidden" name=selectedcharacter value="' . htmlspecialchars($delChar->getName()) . '" >
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
		} else {
			header("Location: ?subtopic=accountmanagement");
		}
	} else {
		header("Location: ?subtopic=accountmanagement");
	}
}
if ($_REQUEST['step'] == "deletecharacter") {
	$charToDelete = new Player();
	$charToDelete->loadByName($_REQUEST['name']);

	$main_content .= '
				<div class="TableContainer" >
					<table class="Table1" cellpadding="0" cellspacing="0" >
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" >
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
								<div class="Text" >Character Deleted</div>
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
											<td>The character <b>' . htmlspecialchars($charToDelete->getName()) . '</b> has been scheduled for deletion. It will be removed permanently from your account on <strong>' . date("M j Y, H:i:s", $charToDelete->getDeletion()) . '</strong>.</td>
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
