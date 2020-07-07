<?php
if (!defined('INITIALIZED'))
    exit;

if (isset($_REQUEST['step']) && $_REQUEST['step'] == "downloadagreement") {
    $main_content .= '
		<p>Before you can download the client program please read the ' . $config['server']['serverName'] . ' Service Agreement and state if you agree to it by clicking on the appropriate button below.</p>
		<div class="TableContainer" >
			<table class="Table1" cellpadding="0" cellspacing="0">
				<div class="CaptionContainer" >
					<div class="CaptionInnerContainer" > 
						<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
						<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
						<div class="Text" >' . $config['server']['serverName'] . ' Service Agreement</div>
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
								<p>This agreement describes the terms on which ' . $config['server']['serverName'] . ' offers you access to an account for being able to play the online role playing game ' . $config['server']['serverName'] . ' Server. By creating an account or downloading the client software you accept the terms and conditions below and state that you are of full legal age in your country or have the permission of your parents to play this game.</p>
								<p>You agree that the use of the software is at your sole risk. We provide the software, the game, and all other services "as is". We disclaim all warranties or conditions of any kind, expressed, implied or statutory, including without limitation the implied warranties of title, non-infringement, merchantability and fitness for a particular purpose. We do not ensure continuous, error-free, secure or virus-free operation of the software, the game, or your account.</p>
								<p>We are not liable for any lost profits or special, incidental or consequential damages arising out of or in connection with the game, including, but not limited to, loss of data, items, accounts, or characters from errors, system downtime, or adjustments of the gameplay.</p>
								<p>While you are playing ' . $config['server']['serverName'] . ' Server, you must abide by some rules ("' . $config['server']['serverName'] . ' Rules") that are stated on this homepage. If you break any of these rules, your account may be removed and all other services terminated immediately.</p>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<br/>
		<center>
		<form action="?subtopic=downloadclient" method="post">
					<tr>
						<td style="border:0px;" ><div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)" >
						<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);" ></div>
						<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_iagree.gif" >
					</div>
				</div>
			</form>
		</center>';
  
} else {
    $main_content .= '
	</br>
	<div class="TableContainer">
		<table class="Table3" cellpadding="0" cellspacing="0"> 
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>                                    
					<div class="Text" ><center>Downloads</center></div>
					<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
				</div>
			</div>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tr>
								<td>
									<div class="TableShadowContainerRightTop"></div>
										<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">    
												<table class="TableContent" width="100%">
													<tr style="background-color:#D4C0A1">
														<td align="center"><b>Links</b></td>
													</tr>
												</table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);">
												<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
												<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>  
											</div>
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
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tr>
								<td>
									<div class="TableShadowContainerRightTop"></div>
										<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">    
												<table class="TableContent" width="100%">
													<tr style="background-color:#D4C0A1">
														<td align="center">
															<b>Client 12 (portable)</b>
															</br>[<span class="HelpLink" style="width: 18px; height: 18px;" ><a href="/common/tibiaclientrequirements.php" target="_blank" ><span class="HelperDivIndicator" onMouseOver="ActivateHelperDiv($(this), \'How to install:\', \'<p>unzip the archive, open the <b>bin</b> folder and use the <b>client.exe</b> to play.\', \'\');" onMouseOut="$(\'#HelperDivContainer\').hide();" >how to install</span></a></span>]
														</td>
														<td align="center">
															<a href="" target="_blank" type="application/octet-stream" target="_top">Mega<br/></a>		
															<a href="" target="_blank" type="application/octet-stream" target="_top">Mediafire<br/></a>																				
														</td>
														<td align="center">
															<b>Client 12 (installer)</b>
														</td>
														<td align="center">
															<a href="" target="_blank" type="application/octet-stream" target="_top"><strike>Mega</strike><br/></a>		
															<a href="" target="_blank" type="application/octet-stream" target="_top"><strike>Mediafire</strike><br/></a>																				
														</td>
													</tr>	
													<tr style="background-color:#D4C0A1">
														<td colspan=4><b>ATENÇÃO!!</b> Não consegue logar? Baixe <a href=""/>este</a> executável, coloque dentro da pasta "bin" e tente abrí-lo.</td>
													</tr>													
												</table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);">
												<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
												<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>  
											</div>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</div>';
}