<?php

if (!defined('INITIALIZED'))
	exit;
$step = $_REQUEST['step'];
if ($logged) {
	require_once("system/load.twoFactors.php");

	$code = $account_logged->getSecretCode();
	if ($_REQUEST['q']) {
		if ($_REQUEST['q'] == "active") {
			if ($code == NULL) {
				$code = generateRandomString(16, false);

				if (isset($_POST['authAccount']) && isset($_POST['code'])) {
					$authToken = htmlspecialchars($_POST['authAccount']);
					$secretCode = htmlspecialchars($_POST['code']);
					if (!TokenAuth6238::verify($secretCode, $authToken)) {
						$main_content .= '
								<div class="SmallBox">
									<div class="MessageContainer">
										<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);"></div>
										<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
										<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
										<div class="ErrorMessage">
											<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></div>
											<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></div>
											<div class="AttentionSign" style="background-image:url(' . $layout_name . '/images/global/content/attentionsign.png);"></div>
												<b>Atenção:</b><br>Você digitou o código errado</a>.
											</div>
										<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);"></div>
										<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
										<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
									</div>
								</div><br>
								<div class="SubmitButtonRow" >
									<div class="CenterButton" >
										<form action="?subtopic=accountmanagement&action=twoAuthentication" method="post" style="padding:0px;margin:0px;" >
											<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
												<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
													<span class="ButtonTextInputs" >Voltar</span>
													<input class="ButtonText" type="image" name="Cancel" alt="cancel" src="' . $layout_name . '/images/global/buttons/_sbutton_cancel.gif" >
												</div>
											</div>
										</form>
									</div>
								</div>';
						return;
					}

					$SQL->query("UPDATE `accounts` SET `secret`= " . $SQL->quote($secretCode) . " WHERE `id` = '" . $account_logged->getID() . "';");
					$main_content .= tibiaTable("2FA ativado!", "O 2FA foi ativado com sucesso na sua conta.");
					$main_content .= '
							<div class="SubmitButtonRow" >
								<div class="CenterButton" >
									<form action="?subtopic=accountmanagement" method="post" style="padding:0px;margin:0px;" >
										<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
											<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
												<span class="ButtonTextInputs" >Voltar</span>
												<input class="ButtonText" type="image" name="Cancel" alt="Cancel" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" >
											</div>
										</div>
									</form>
								</div>
							</div>';
					return;
				}

				$main_content .= '
						<form action="" method="POST">
						<input type="hidden" name="code" value="' . $code . '">
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" >
										<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
										<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
										<div class="Text" >Two-Factor Authentication!</div>
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
													<td>Utilize o QRCode abaixo no Authy ou então em algum aplicação autenticador:
													<br><br>
														<center><img src="' . TokenAuth6238::getBarCodeUrl($account_logged->getName(), $_SERVER["HTTP_HOST"], $code, $config['server']['serverName']) . '" alt="Two-Factor Authentication QR code image for this account."/></center>
													</td>
												</tr>
												<tr>
													<td><br><br><center><strong>Por favor escaneie o código acima e coloca aqui em baixo os 6 números para ativar o 2FA em sua conta</strong><br><br>
														<input type="text" class="accinput" id="authAccount" name="authAccount" placeholder="Code" maxlength="6" required></center>
													</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
							</table>
						</div>
						</br>
						<table width="100%" >
							<tr align="center" >
								<td>
									<table border="0" cellspacing="0" cellpadding="0" >
										<tr>
											<td style="border:0px;" >
												<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
													<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
														<span class="ButtonTextInputs" >Ativar 2FA!</span>
														<input class="ButtonText" type="image" name="Ativar" alt="Ativar" src="' . $layout_name . '/images/global/buttons/_sbutton_confirm.gif" >
													</div>
												</div>
											</td>
										</tr>
									</table>
								</td>
								</form>
								<td>
									<table border="0" cellspacing="0" cellpadding="0" >
										<form action="?subtopic=accountmanagement&action=twoAuthentication" method="post">
											<tr>
												<td style="border:0px;" >
													<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
														<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
														<span class="ButtonTextInputs" >Voltar</span>
														<input class="ButtonText" type="image" name="Voltar" alt="Voltar" src="' . $layout_name . '/images/global/buttons/_sbutton_cancel.gif" >
													</div>
												</td>
											</tr>
										</form>
									</table>
								</td>
							</tr>
						</table>';
			} else {
				$main_content .= showError("A verificação em dois passos da sua conta já está ativada.");
				$main_content .= '<br/><table style="width:100%;" ><tr align="center"><td><table border="0" cellspacing="0" cellpadding="0" ><form action="?subtopic=accountmanagement" method="post" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" ></div></div></td></tr></form></table></td></tr></table>';
			}
		} elseif ($_REQUEST['q'] == "desativar") {
			if ($code === NULL) {
				$main_content .= showError("Essa conta não possui verificação em dois passos.");
				$main_content .= '<br/><table style="width:100%;" ><tr align="center"><td><table border="0" cellspacing="0" cellpadding="0" ><form action="?subtopic=accountmanagement&action=twoAuthentication" method="post" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" ><div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_back.gif" ></div></div></td></tr></form></table></td></tr></table>';
				return;
			}

			if (isset($_POST['authAccount']) && isset($_POST['code'])) {
				$authToken = htmlspecialchars($_POST['authAccount']);
				$secretCode = htmlspecialchars($_POST['code']);
				if (!TokenAuth6238::verify($secretCode, $authToken)) {
					$main_content .= '
							<div class="SmallBox">
								<div class="MessageContainer">
									<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);"></div>
									<div class="BoxFrameEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
									<div class="BoxFrameEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
									<div class="ErrorMessage">
										<div class="BoxFrameVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></div>
										<div class="BoxFrameVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></div>
										<div class="AttentionSign" style="background-image:url(' . $layout_name . '/images/global/content/attentionsign.png);"></div>
											<b>Atenção:</b><br>Você digitou o código errado</a>.
										</div>
									<div class="BoxFrameHorizontal" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-horizontal.gif);"></div>
									<div class="BoxFrameEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
									<div class="BoxFrameEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></div>
								</div>
							</div><br>
							<div class="SubmitButtonRow" >
								<div class="CenterButton" >
									<form action="?subtopic=accountmanagement&action=twoAuthentication" method="post" style="padding:0px;margin:0px;" >
										<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
											<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
												<span class="ButtonTextInputs" >Voltar</span>
												<input class="ButtonText" type="image" name="Change Password" alt="Change Password" src="' . $layout_name . '/images/global/buttons/_sbutton_cancel.gif" >
											</div>
										</div>
									</form>
								</div>
							</div>';
					return;
				}

				$SQL->query("UPDATE `accounts` SET `secret`= NULL WHERE `id`= '" . $account_logged->getID() . "';");
				$main_content .= tibiaTable("2FA desativado!", "O 2FA foi desativado com sucesso da sua conta.");
				$main_content .= '
						<div class="SubmitButtonRow" >
							<div class="CenterButton" >
								<form action="?subtopic=accountmanagement" method="post" style="padding:0px;margin:0px;" >
									<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
											<span class="ButtonTextInputs" >Voltar</span>
											<input class="ButtonText" type="image" name="Back" alt="back" src="' . $layout_name . '/images/global/buttons/sbutton_back.gif" >
										</div>
									</div>
								</form>
							</div>
						</div>';
				return;
			}

			$main_content .= '
					<form action="" method="POST">
					<input type="hidden" name="code" value="' . $code . '">
					<div class="TableContainer" >
						<table class="Table1" cellpadding="0" cellspacing="0" >
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" >
									<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
									<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Two-Factor Authentication!</div>
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
													<strong>Por favor digite o código pela a última vez para ser removido o 2FA de sua conta.</strong><br><br>
													<center><input type="text" class="accinput" id="authAccount" name="authAccount" placeholder="Code" maxlength="6" required></center>
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div>
					</br>
					<table width="100%" >
						<tr align="center" >
							<td>
								<table border="0" cellspacing="0" cellpadding="0" >
									<tr>
										<td style="border:0px;" >
											<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)" >
												<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);" ></div>
													<span class="ButtonTextInputs" >Desativar 2FA!</span>
													<input class="ButtonText" type="image" name="Desativar" alt="Desativar" src="' . $layout_name . '/images/global/buttons/_sbutton_confirm.gif" >
												</div>
											</div>
										</td>
									</tr>
								</table>
							</td>
							</form>
							<td>
								<table border="0" cellspacing="0" cellpadding="0" >
									<form action="?subtopic=accountmanagement&action=twoAuthentication" method="post">
										<tr>
											<td style="border:0px;" >
												<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
													<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
													<span class="ButtonTextInputs" >Voltar</span>
													<input class="ButtonText" type="image" name="Voltar" alt="Voltar" src="' . $layout_name . '/images/global/buttons/_sbutton_cancel.gif" >
												</div>
											</td>
										</tr>
									</form>
								</table>
							</td>
						</tr>
					</table>';
		}

		return;
	}

	$status = ($code === NULL) ? false : true;
	$main_content .= '
				<div class="TableContainer" style="position:relative;">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer">
							<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">Two Factor Authentication</div>
							<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
							<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
							<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
							<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
						</div>
					</div>
					<table class="Table4" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								<div class="InnerTableContainer">
									<table style="width:100%;">
										<tr>
											<td>
												<div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
															<tr>
																<td style="text-align: center;padding-center: 80px;">
																   <b style="color: brown;">O que é isso?</b><br>
																   Two Factor Authentication é um tipo de mecanismo de autenticação, onde é necessário mais que um componente para autenticar o usuário. Este sistema foi desenvolvido para aumentar a segurança, garantir os direitos de acesso individuais e diminuir os risco de fraude nas comunicações.
																</td>
															</tr>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
														<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
														<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
															<tbody>
																<tr bgcolor="#D4C0A1">
																	<td align="center"><strong>Status</strong></td>
																	<td>
																		' . (($status) ? '<font color="green">Ativado</font>. <a href="?subtopic=accountmanagement&action=twoAuthentication&q=desativar">Clique aqui</a> para desativar.' : '<font color="red">Desativado</font>. <a href="?subtopic=accountmanagement&action=twoAuthentication&q=active">Clique aqui</a> para ativar.') . '
																	</td>
																</tr>
																<tr bgcolor="#D4C0A1">
																	<td align="center"><strong>Instruções</strong></td>
																	<td><ol><li>Baixe um aplicação autenticador no seu celular tipo <strong>Authy</strong> (<a target="_BLANK" href="https://play.google.com/store/apps/details?id=com.authy.authy">Android</a>), (<a target="_BLANK" href="https://itunes.apple.com/us/app/authy/id494168017">iPhone</a>) ou <strong>Google Authenticator</strong> (<a target="_BLANK" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2">Android</a>), (<a target="_BLANK" href="https://itunes.apple.com/us/app/google-authenticator/id388497605">iPhone</a>).</li><li>Scanei o seu QRCode com esse aplicativo para colocar o sistema de verificação em dois passos na sua conta.</li></ol></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
														<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);"></div>
														<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);"></div>
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
				<div class="SubmitButtonRow" >
					<div class="CenterButton" >
						<form action="?subtopic=accountmanagement" method="post" style="padding:0px;margin:0px;" >
							<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);" ></div>
									<span class="ButtonTextInputs" >Voltar</span>
									<input class="ButtonText" type="image" name="Back" alt="back" src="' . $layout_name . '/images/global/buttons/_sbutton_cancel.gif" >
								</div>
							</div>
						</form>
					</div>
				</div>';
} else {
	header("location: ./?subtopic=accountmanagement");
}
