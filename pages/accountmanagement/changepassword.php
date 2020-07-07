<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 18:14
 */

if (!isset($_REQUEST['passwordchanged']) && $_REQUEST['passwordchanged'] != "done") {
	if (isset($_POST['step']) && $_POST['step'] == "change") {
		if (empty($_POST['newpassword']))
			$newpassword_errors[] = "Please enter a new password!";
		elseif (empty($_POST['newpassword2']))
			$new2password_errors[] = "Please enter the new password again!";
		elseif (empty($_POST['oldpassword']))
			$oldpassword_errors[] = "Please enter your current password!";
		if ($_POST['newpassword'] != $_POST['newpassword2'])
			$new2password_errors[] = "The new passwords do not match!";
		if (strlen($_POST['newpassword']) < 8 || strlen($_POST['newpassword']) > 30)
			$newpassword_errors[] = "The new password must have at least 8 and less than 30 letters!";
		$newpassRed = 'class"red"';
		if (!preg_match('/[a-zA-Z]/', $_POST['newpassword'])) {
			$newpassword_errors[] = 'The password must contain at least one letter A-Z or a-z!';
			$newpassRed = 'class"red"';
		} elseif (!preg_match('/[0-9]/', $_POST['newpassword'])) {
			$newpassword_errors[] = 'The password must contain at least one letter other than A-Z or a-z!';
			$newpassRed = "class=red";
		}
		if (!empty($_POST['oldpassword']))
			if (!$account_logged->isValidPassword($_POST['oldpassword']))
				$oldpassword_errors[] = "Current password is not correct!";

		if (!empty($newpassword_errors) || !empty($new2password_errors) || !empty($oldpassword_errors)) {
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
									<b>The following errors have occurred:</b><br/>';
			if (!empty($newpassword_errors))
				foreach ($newpassword_errors as $newpassError)
					$main_content .= $newpassError . '<br />';
			if (!empty($new2password_errors))
				foreach ($new2password_errors as $newpass2Error)
					$main_content .= $newpass2Error . '<br />';
			if (!empty($oldpassword_errors))
				foreach ($oldpassword_errors as $oldpassError)
					$main_content .= $oldpassError . '<br />';
			$main_content .= '
								</div>
								<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
								<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
								<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
							</div>
						</div>
						<br/>';
		} else {
			$account_logged->setPassword($_POST['newpassword']);
			$account_logged->save();
			Visitor::setPassword($_POST['newpassword']);
			header("Location: ?subtopic=accountmanagement&action=passowordchanged");
		}
	}
	$main_content .= 'Please enter your current password and a new password. Please verify your new password by entering it twice.<br/><br/>';

	$main_content .= '
				<form action="?subtopic=accountmanagement&action=changepassword" method="post" >
					<div class="TableContainer" >
						<table class="Table1" cellpadding="0" cellspacing="0" >
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" >
									<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Change Password</div>
									<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								</div>
							</div>';
	$main_content .= '
							<tr>
								<td>
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td class="LabelV" ><span ' . ((!empty($newpassword_errors)) ? "class=red" : "") . '>New Password:</span></td>
												<td style="width:90%;" ><input type="password" name="newpassword" size="30" maxlength="29" ></td>
											</tr>
											<tr>
												<td class="LabelV" ><span ' . ((!empty($new2password_errors)) ? "class=red" : "") . '>New Password Again:</span></td>
												<td><input type="password" name="newpassword2" size="30" maxlength="29" ></td>
											</tr>
											<tr>
												<td class="LabelV" ><span ' . ((!empty($oldpassword_errors)) ? "class=red" : "") . '>Current Password:</span></td>
												<td><input type="password" name="oldpassword" size="30" maxlength="29" ></td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<br/>
					<table style="width:100%;" >
					<tr align="center">
						<td>
							<table border="0" cellspacing="0" cellpadding="0" >
								<tr>
									<td style="border:0px;" >
										<input type="hidden" name="step" value="change" >
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
				<td>
					<table border="0" cellspacing="0" cellpadding="0" >
						<form action="?subtopic=accountmanagement&action=manage" method="post" >
							<tr>
								<td style="border:0px;" >
									<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
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
} else
	$main_content .= '
				<div class="TableContainer" >
					<table class="Table1" cellpadding="0" cellspacing="0" >
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" > <span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
								<div class="Text" >Password Changed</div>
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
											<td>Your password has been changed.</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<center>
					<table border="0" cellspacing="0" cellpadding="0" >
						<form action="https://secure.tibia.com/account/?subtopic=accountmanagement" method="post" >
							<tr>
								<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
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
