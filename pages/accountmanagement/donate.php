<?php
if(!defined('INITIALIZED'))
	exit;
	
if($logged) {
	
	#Progress bar
	# Donate of 5 steps
	
	if(!isset($_REQUEST['step']) || $_REQUEST['step'] == "")
		$step = 1;
	else $step = $_REQUEST['step'];
	
	$main_content .= '
		<div id="ProgressBar">
			<div id="Headline">Donate Page</div>
			<div id="MainContainer">
				<div id="BackgroundContainer"> 
					<img id="BackgroundContainerLeftEnd" src="'.$layout_name.'/images/global/content/progressbar/stonebar-left-end.gif">
					<div id="BackgroundContainerCenter">
						<div id="BackgroundContainerCenterImage" style="background-image:url('.$layout_name.'/images/global/content/stonebar-center.gif);" />
					</div>
					<img id="BackgroundContainerRightEnd" src="'.$layout_name.'/images/global/content/progressbar/stonebar-right-end.gif"> 
				</div>
				<img id="TubeLeftEnd" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-left-green.gif"> 
				<img id="TubeRightEnd" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-right-'.(($step >= 5) ? 'green' : 'blue').'.gif">
				<div id="FirstStep" class="Steps">
					<div class="SingleStepContainer"> 
						<img class="StepIcon" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-icon-0-green.gif">
						<div class="StepText" style="font-weight: '.(($step == 1) ? 'bold' : 'normal').';">Information</div>
					</div>
				</div>
				<div id="StepsContainer1">
					<div id="StepsContainer2">
						<div class="Steps" style="width: 25%;">
							<div class="TubeContainer"> 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-green'.(($step == 1) ? '-blue' : '').'.gif"> </div>
							<div class="SingleStepContainer"> 
								<img class="StepIcon" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-icon-1-'.(($step >= 2) ? 'green' : 'blue').'.gif">
								<div class="StepText" style="font-weight: '.(($step == 2) ? 'bold' : 'normal').';">Donate Method</div>
							</div>
						</div>
						<div class="Steps" style="width: 25%;">
							<div class="TubeContainer">';
						if($step < 2)
							$main_content .= ' 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-blue.gif">';
						elseif($step == 2)
							$main_content .= ' 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-green-blue.gif">';
						else
							$main_content .= ' 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-green.gif">';
						$main_content .= ' 
							</div>
							<div class="SingleStepContainer"> 
								<img class="StepIcon" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-icon-2-'.(($step >= 3) ? 'green' : 'blue').'.gif">
								<div class="StepText" style="font-weight: '.(($step == 3) ? 'bold' : 'normal').';">Choose Coins Package</div>
							</div>
						</div>
						<div class="Steps" style="width: 25%;">
							<div class="TubeContainer">';
						if($step == 3)
							$main_content .= ' 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-green-blue.gif">';
						elseif($step >= 4)
							$main_content .= ' 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-green.gif">';
						else
							$main_content .= ' 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-blue.gif">';
						$main_content .= '  
							</div>
							<div class="SingleStepContainer"> 
								<img class="StepIcon" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-icon-3-'.(($step >= 4) ? 'green' : 'blue').'.gif">
								<div class="StepText" style="font-weight: '.(($step == 4) ? 'bold' : 'normal').';">Order Confirmation</div>
							</div>
						</div>
						<div class="Steps" style="width: 25%;">
							<div class="TubeContainer">';
						if($step == 4)


							$main_content .= ' 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-green-blue.gif">';
						elseif($step == 5)
							$main_content .= ' 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-green.gif">';
						else
							$main_content .= ' 
								<img class="Tube" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-tube-blue.gif">';
						$main_content .= ' 
							</div>
							<div class="SingleStepContainer"> 
								<img class="StepIcon" src="'.$layout_name.'/images/global/content/progressbar/progress-bar-icon-4-'.(($step >= 5) ? 'green' : 'blue').'.gif">
								<div class="StepText" style="font-weight: '.(($step == 5) ? 'bold' : 'normal').';">Summary</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>';
		
		if($step == 1) {
			# Step 1
			# Rules to donate, and information
			
			$main_content .= '
				<form method="post" action="?subtopic=accountmanagement&action=donate">
				<div class="TableContainer">
					<div class="CaptionContainer">
						<div class="CaptionInnerContainer"> 
							<span class="CaptionEdgeLeftTop" style="background-image: url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
							<span class="CaptionEdgeRightTop" style="background-image: url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
							<span class="CaptionBorderTop" style="background-image: url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span> 
							<span class="CaptionVerticalLeft" style="background-image: url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
							<div class="Text">Initial information for your donation</div>
							<span class="CaptionVerticalRight" style="background-image: url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span> 
							<span class="CaptionBorderBottom" style="background-image: url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span> 
							<span class="CaptionEdgeLeftBottom" style="background-image: url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
							<span class="CaptionEdgeRightBottom" style="background-image: url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span> 
						</div>
					</div>
					<table class="Table1" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width: 100%;">
											<tbody>
												<tr>
													<td>We inform the players and staff that '.$config['server']['serverName'].' has no financial interest. All income is obtained directly reapplied for server maintenance - this means that to make a donation, you are ensuring the stability and increasing quality.</br>
														</br>
														The coins that are given to the players that perform the donations represent nothing beyond our gratification, that is, you are not buying points but getting a symbolic gratification (in form of points) that will benefit you in the game; you can use your points any way you want.</br>
														No refund amount of donations for all is applied to the monthly expenses.</br>
														The spirit of this system is simple: in order to approach the players and make you feel at home, we understand your donations as a two-way street in the question credibility. To believe that it is worth investing in server maintenance, we focus on you by crediting them with points, which as stated previously, can be used in the way best fits them.</br>
														</br>
														Check out <a href="?subtopic=accountmanagement&action=manage#Products+Available">'.$config['server']['serverName'].' Shop</a> and see how you can make your points in the most profitable way to your situation.</br>
														<h3>Frequently Asked question</h3>
														<b>But what are Tibia Coins ?</b> Tibia Coins is part of our donation system, with them you can purchase a VIP or something else that is available in the Shopping Online.</br>
														</br>
														If you accept our terms of donation and understand the purpose of it, click <strong>"Next"</strong>.</td>
												</tr>
											</tbody>
										</table>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>';
				
			$main_content .= '
				<div class="SubmitButtonRow" >
					<div class="LeftButton" >
						<input type="hidden" name="step" value="2" >
						<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
							<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
								<input class="ButtonText" type="image" name="Next" alt="Next" src="'.$layout_name.'/images/global/buttons/_sbutton_next.gif" >
							</div>
						</div>
					</div>
					</form>
					<div class="RightButton" >
						<form method="post" action="?subtopic=accountmanagement&action=manage" >
							<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/global/buttons/_sbutton_back.gif" >
								</div>
							</div>
						</form>
					</div>
				</div>';
		}
		
		if($step == 2) {
			
			$main_content .= '
				<form method="post" action="?subtopic=accountmanagement&action=donate">
					<div class="TableContainer" >
						<table class="Table5" cellpadding="0" cellspacing="0">
						<div class="CaptionContainer" >
							<div class="CaptionInnerContainer" > 
								<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
								<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
								<div class="Text" >Choose Donate Method</div>
								<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span> 
								<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
								<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
							</div>
						</div>
						<tr>
							<td>
								<div class="InnerTableContainer">
									<table style="width:100%;" >
										<tr>
											<td>
												<div class="TableShadowContainerRightTop" >
													<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
													<div class="TableContentContainer" >
														<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
															<tr>
																<td><input type="radio" name="donateMethod" value="pagseguro" '.(($_REQUEST['donateMethod'] == "pagseguro") ? 'checked' : 'checked').'></td>
																<td class="LabelV" style="vertical-align: inherit;">PagSeguro</td>
																<td>This method doesn\'t require confirmation. Coins are credited to your account automatically.</td>
															</tr>														
														</table>
													</div>
												</div>											
												<div class="TableShadowContainer" >
													<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
														<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
														<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
													</div>
												</div>
											</td>
										</tr>';

            /*$main_content .= '
                <tr>
                    <td>
                        <div class="TableShadowContainerRightTop" >
                            <div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
                        </div>
                        <div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
                            <div class="TableContentContainer" >
                                <table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
                                    <tr>
                                        <td><input type="radio" name="donateMethod" value="paypal" '.(($_REQUEST['donateMethod'] == "paypal") ? 'checked' : '').'></td>
                                        <td class="LabelV">PayPal</td>
                                        <td>This method requires confirmation. Access your donation history and confirm this donation.</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="TableShadowContainer" >
                            <div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
                                <div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
                                <div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
                            </div>
                        </div>
                    </td>
                </tr>';
            $main_content .= '
                <tr>
                    <td>
                        <div class="TableShadowContainerRightTop" >
                            <div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
                        </div>
                        <div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
                            <div class="TableContentContainer" >
                                <table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
                                    <tr>
                                        <td><input type="radio" name="donateMethod" value="banktransfer" '.(($_REQUEST['donateMethod'] == "banktransfer") ? 'checked' : '').'></td>
                                        <td class="LabelV">Bank Transfer</td>
                                        <td>This method requires confirmation. Access your donation history and confirm this donation.</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="TableShadowContainer" >
                            <div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
                                <div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
                                <div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
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
<p style="color:red;">Paypal foi desativado temporariamente, pedimos sua paciencia. Em breve estara normalizado.</p>';*/

			
			$main_content .= '
									</table>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="SubmitButtonRow" >
					<div class="LeftButton" >
						<input type="hidden" name="step" value="3">
						<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
							<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
								<input class="ButtonText" type="image" name="Next" alt="Next" src="'.$layout_name.'/images/global/buttons/_sbutton_next.gif" >
							</div>
						</div>
					</div>
					</form>
					<div class="RightButton" >
						<form method="post" action="?subtopic=accountmanagement&action=donate">
							<input type="hidden" name="step" value="1">
							<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Previous" alt="Previous" src="'.$layout_name.'/images/global/buttons/_sbutton_previous.gif" >
								</div>
							</div>
						</form>
					</div>
				</div>';
		}
		
		if($step == 3) {
			
			$donateMethod = $_REQUEST['donateMethod'];
			
			if(!isset($donateMethod) || $donateMethod == "")
				$donate_errors[] = "You need to select a method to make your donation.";
			if(!empty($donate_errors)) {
				$main_content .= '
					<div class="TableContainer" >
						<table class="Table1" cellpadding="0" cellspacing="0" >
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>							
									<div class="Text" >Donate Errors</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>';
												foreach($donate_errors as $error)
													$main_content .= $error . '<br>';
											$main_content .= '
												</td>
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
									<form action="?subtopic=accountmanagement&action=donate" method="post">
										<input type="hidden" name="step" value="2">
										<tr>
											<td style="border:0px;" ><div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
													<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
														<input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/global/buttons/_sbutton_back.gif" >
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
				# Pagseguro Method
				if($donateMethod == "pagseguro") {
					$doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
                    $_POST['item_quant_1'];
                    $_POST['account_namev'];
                    $_POST['emailv'];
                    $_POST['character_namev'];

                    $main_content .= '<form action="?subtopic=accountmanagement&action=donate" method="post" enctype="application/x-www-form-urlencoded"
                          xmlns:https="http://www.w3.org/1999/xhtml">
                        <div class="TableContainer">
                            <div class="CaptionContainer">
                                <div class="CaptionInnerContainer">
                                    <span class="CaptionEdgeLeftTop"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
                                    <span class="CaptionEdgeRightTop"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
                                    <span class="CaptionBorderTop"
                                          style="background-image: url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
                                    <span class="CaptionVerticalLeft"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
                                    <div class="Text">Account Information</div>
                                    <span class="CaptionVerticalRight"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
                                    <span class="CaptionBorderBottom"
                                          style="background-image: url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
                                    <span class="CaptionEdgeLeftBottom"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
                                    <span class="CaptionEdgeRightBottom"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
                                </div>
                            </div>
                            <table class="Table1" cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="InnerTableContainer">
                                            <table style="width: 100%;">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <table>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Account Name:</b></td>
                                                                <td><input type="hidden" value="' . $account_logged->getName() . '" name="account_namev"/>' . $account_logged->getCustomField("name") . '
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Email:</b></td>
                                                                <td><input type="hidden" value="' . $account_logged->getCustomField("email") . '" name="emailv"/>' . $account_logged->getCustomField("email") . '
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <br/>
                        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css"/>
                        <div class="TableContainer">
                            <div class="CaptionContainer">
                                <div class="CaptionInnerContainer">
                                    <span class="CaptionEdgeLeftTop"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
                                    <span class="CaptionEdgeRightTop"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
                                    <span class="CaptionBorderTop"
                                          style="background-image: url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
                                    <span class="CaptionVerticalLeft"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
                                    <div class="Text">Donation Package</div>
                                    <span class="CaptionVerticalRight"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
                                    <span class="CaptionBorderBottom"
                                          style="background-image: url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
                                    <span class="CaptionEdgeLeftBottom"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
                                    <span class="CaptionEdgeRightBottom"
                                          style="background-image: url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
                                </div>
                            </div>
                            <table class="Table1" cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="InnerTableContainer">
                                            <table style="width: 100%;">
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <script>
                                                            // change the selected service
                                                            function ChangeService(a_ServiceID) {
                                                                // console.log("### ChangeService() ### a_ServiceID #" + a_ServiceID + "# a_ServiceCategoryID #" + a_ServiceCategoryID + "#");
                                                                // set the ServiceID for the change country form
                                                                var serviceID = $("#CC_ServiceID");
                                                                serviceID.val(a_ServiceID);
                                                                serviceID.attr("name", "InitialServiceID");
                                                                // activate the radio button itself and set the price
                                                                $("#ServiceID_" + a_ServiceID).attr("checked", "checked");
                                                                $(".ServiceID_Icon_Container").css("background-color", "");
                                                                                                            
                                                                // activate and mark the selected icon
                                                                $(".ServiceID_Icon_Selected").css("background-image", "");
                                                                $("#ServiceID_Icon_Selected_" + a_ServiceID).css("background-image", "url(' . $layout_name . '/images/payment/serviceid_icon_selected.png)");
                                                                return;
                                                            }
                                                        </script>';

                                        $countOffer=1;

                                        foreach ($config['pagseguro']['offers'] as $price => $coinCount){
                                            $main_content .= '
                                                            <div class="ServiceID_Icon_Container w3-card-4" id="ServiceID_Icon_Container_' . $price . '">
                                                                <div class="ServiceID_Icon_Container_Background" id=""
                                                                     style="background-image:url(' . $layout_name . '/images/payment/serviceid_icon_normal.png);">
                                                                    <div class="ServiceID_Icon" id="ServiceID_Icon_' . $price . '" style=""
                                                                         onclick="ChangeService('.$price.');">
                                                                        <div class="ServiceID_Icon_New" id="ServiceID_Icon_New_' . $price . '"
                                                                             style="background-image:url(' . $layout_name . '/images/payment/serviceid_' . $countOffer . '.png);">
                                                                        </div>
                                                                        <div class="ServiceID_Icon_Selected" id="ServiceID_Icon_Selected_' . $price . '">
                                                                        </div>                                                
                                                                        <label for="ServiceID_' . $price . '">
                                                                            <div class="ServiceIDLabelContainer">
                                                                                <div class="ServiceIDLabel">
                                                                                    <input id="ServiceID_' . $price . '" name="ServiceID" value="' . $price . '"
                                                                                       style="display: none;"
                                                                                       type="radio">' . $coinCount . ' Coins
                                                                                </div>
                                                                            </div>
                                                                            <div class="ServiceIDPriceContainer">
                                                                                <span class="ServiceIDPrice" id="PD_133">R$ '.($price/100).',00</span> *
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>';
                                            $countOffer++;
                                        };
                                        unset($countOffer);

                                        $main_content.= '<script>
                                                            function selectDefault(){    
                                                                
                                                                ChangeService(' .current(array_keys($config['pagseguro']['offers'])) . ');                                            
                                                            }
                                                            
                                                            $(document).ready(selectDefault())                                    
                                                            
                                                        </script>
                    
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Todas as doações feitas pelo pagseguro são automatizadas. 
                                                        Os pontos são entregues assim que o pagseguro confirma a transação aos nossos servidores. 
                                                            <br/>                                                            
                                                        </small>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <br/>
                        <table width="100%">
                            <tbody>
                            <tr align="center">
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td style="border: 0px none;">
                                                <div class="BigButton"
                                                     style="background-image: url(' . $layout_name . '/images/global/buttons/sbutton.gif);">
                                                <div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver"
                                                         style="background-image: url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);"></div>
                                                    <input type="hidden" name="step" value="4">
                                                    <input type="hidden" name="donateMethod" value="'.$donateMethod.'">
                                                    <input class="ButtonText" name="Continue" alt="Continue"
                                                           src="' . $layout_name . '/images/global/buttons/_sbutton_continue.gif" type="image">
                                                </div>
                                            </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                    </table>
                    ';

				}
				
				# Paypal Method
				if($donateMethod == "paypal") {
					$doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
					$main_content .= '
						<div class="TableContainer" style="position:relative;">
						<style>
							.ribbonShop-double {
							background:url('.$layout_name.'/images/shop/ribbon-double.png) no-repeat;
							width: 80px;
							height: 80px;
							position:absolute;
							right: -5px;
							top: -5px;
							z-index:999;
						}
						</style>
						'.(($doubleStatus['value'] == "active") ? '<div class="ribbonShop-double"></div>' : '').'
							<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Tibia Coins Package</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span> 
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr bgcolor="'.$config['site']['darkborder'].'">
																	<td class="LabelV">Donation Price</td>
																	<td class="LabelV">Amount Points</td>
																</tr>
																<tr bgcolor="'.$config['site']['lightborder'].'">
																	<td>R$ 5,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>5 points</strike> = <font color="green">10 points</font>' : '5 points').'</td>
																</tr>
																<tr bgcolor="'.$config['site']['darkborder'].'">
																	<td>R$ 10,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>10 points</strike> = <font color="green">20 points</font>' : '10 points').'</td>
																</tr>
																<tr bgcolor="'.$config['site']['lightborder'].'">
																	<td>R$ 20,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>20 points</strike> = <font color="green">40 points</font>' : '20 points').'</td>
																</tr>
																<tr bgcolor="'.$config['site']['darkborder'].'">
																	<td>R$ 40,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>40 points</strike> = <font color="green">80 points</font>' : '40 points').'</td>
																</tr>
																<tr bgcolor="'.$config['site']['lightborder'].'">
																	<td>R$ 60,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>60 points</strike> = <font color="green">120 points</font>' : '60 points').'</td>
																</tr>														
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div><br>';
					$main_content .= '
						<form method="post" action="?subtopic=accountmanagement&action=donate">
						<div class="TableContainer" >
							<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Choose Points Package</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span> 
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td class="LabelV">Points Package</td>
																	<td>
																		<select name="pointsPackage">
																			<option value="5" '.(($_REQUEST['pointsPackage'] == 5) ? 'selected' : '').'>5 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="10" '.(($_REQUEST['pointsPackage'] == 10) ? 'selected' : '').'>10 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="15" '.(($_REQUEST['pointsPackage'] == 15) ? 'selected' : '').'>15 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="20" '.(($_REQUEST['pointsPackage'] == 20) ? 'selected' : '').'>20 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="25" '.(($_REQUEST['pointsPackage'] == 25) ? 'selected' : '').'>25 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="30" '.(($_REQUEST['pointsPackage'] == 30) ? 'selected' : '').'>30 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="35" '.(($_REQUEST['pointsPackage'] == 35) ? 'selected' : '').'>35 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="40" '.(($_REQUEST['pointsPackage'] == 40) ? 'selected' : '').'>40 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="45" '.(($_REQUEST['pointsPackage'] == 45) ? 'selected' : '').'>45 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="50" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>50 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="60" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>60 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="70" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>70 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="80" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>80 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="90" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>90 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="100" '.(($_REQUEST['pointsPackage'] == 100) ? 'selected' : '').'>100 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="150" '.(($_REQUEST['pointsPackage'] == 150) ? 'selected' : '').'>150 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="200" '.(($_REQUEST['pointsPackage'] == 200) ? 'selected' : '').'>200 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="250" '.(($_REQUEST['pointsPackage'] == 250) ? 'selected' : '').'>250 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="300" '.(($_REQUEST['pointsPackage'] == 300) ? 'selected' : '').'>300 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																		</select>
																	</td>
																</tr>										
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
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
					$main_content .= '
						<div class="SubmitButtonRow" >
							<div class="LeftButton" >
								<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
								<input type="hidden" name="step" value="4">
								<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Next" alt="Next" src="'.$layout_name.'/images/global/buttons/_sbutton_next.gif" >
									</div>
								</div>
							</div>
							</form>
							<div class="RightButton" >
								<form method="post" action="?subtopic=accountmanagement&action=donate">
									<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
									<input type="hidden" name="step" value="2">
									<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
											<input class="ButtonText" type="image" name="Previous" alt="Previous" src="'.$layout_name.'/images/global/buttons/_sbutton_previous.gif" >
										</div>
									</div>
								</form>
							</div>
						</div>';
				}
				
				# Bank Method
				if($donateMethod == "banktransfer") {
					$doubleStatus = $SQL->query("SELECT `value` FROM `server_config` WHERE `config` = 'double'")->fetch();
					$main_content .= '
						<div class="TableContainer" style="position:relative;">
						<style>
							.ribbonShop-double {
							background:url('.$layout_name.'/images/shop/ribbon-double.png) no-repeat;
							width: 80px;
							height: 80px;
							position:absolute;
							right: -5px;
							top: -5px;
							z-index:999;
						}
						</style>
						'.(($doubleStatus['value'] == "active") ? '<div class="ribbonShop-double"></div>' : '').'
							<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Points Package</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span> 
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr bgcolor="'.$config['site']['darkborder'].'">
																	<td class="LabelV">Donation Price</td>
																	<td class="LabelV">Amount Points</td>
																</tr>
																<tr bgcolor="'.$config['site']['lightborder'].'">
																	<td>R$ 5,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>5 points</strike> = <font color="green">10 points</font>' : '5 points').'</td>
																</tr>
																<tr bgcolor="'.$config['site']['darkborder'].'">
																	<td>R$ 10,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>10 points</strike> = <font color="green">20 points</font>' : '10 points').'</td>
																</tr>
																<tr bgcolor="'.$config['site']['lightborder'].'">
																	<td>R$ 20,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>20 points</strike> = <font color="green">40 points</font>' : '20 points').'</td>
																</tr>
																<tr bgcolor="'.$config['site']['darkborder'].'">
																	<td>R$ 40,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>40 points</strike> = <font color="green">80 points</font>' : '40 points').'</td>
																</tr>
																<tr bgcolor="'.$config['site']['lightborder'].'">
																	<td>R$ 60,00</td>
																	<td>'.(($doubleStatus['value'] == "active") ? '<strike>60 points</strike> = <font color="green">120 points</font>' : '60 points').'</td>
																</tr>														
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div><br>';
					$main_content .= '
						<form method="post" action="?subtopic=accountmanagement&action=donate">
						<div class="TableContainer" >
							<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Choose the Bank</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span> 
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr bgcolor="'.$config['site']['darkborder'].'">
																	<td><input type="radio" name="bankname" value="Caixa Economica"></td>
																	<td align="center" width="20%">
																		<img src="'.$layout_name.'/images/payment/caixa.png" width="75px"><br>
																		Caixa Econômica
																	</td>
																	<td>
																		Faça o depósito nas agências da <b>Caixa Econômica Federal</b> ou <b>Transferência Online</b> e nas lotéricas.<br><br>
																		<b>Caixa Econômica</b><br>																
																		<strong>Favorecido</strong>: Luis Felipe Monteiro<br>
																		<strong>Agência:</strong> 1951<br>
																		<strong>Conta:</strong> 22454-7<br>
																		<strong>Operação:</strong> 001<br>
																		<strong>(<em>Conta Corrente </em>)</strong><br>
																	</td>
																</tr>																													
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div><br>
						<div class="TableContainer" >
							<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Choose Points Package</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span> 
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td class="LabelV">Points Package</td>
																	<td>
																		<select name="pointsPackage">
																			<option value="5" '.(($_REQUEST['pointsPackage'] == 5) ? 'selected' : '').'>5 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="10" '.(($_REQUEST['pointsPackage'] == 10) ? 'selected' : '').'>10 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="15" '.(($_REQUEST['pointsPackage'] == 15) ? 'selected' : '').'>15 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="20" '.(($_REQUEST['pointsPackage'] == 20) ? 'selected' : '').'>20 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="25" '.(($_REQUEST['pointsPackage'] == 25) ? 'selected' : '').'>25 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="30" '.(($_REQUEST['pointsPackage'] == 30) ? 'selected' : '').'>30 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="35" '.(($_REQUEST['pointsPackage'] == 35) ? 'selected' : '').'>35 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="40" '.(($_REQUEST['pointsPackage'] == 40) ? 'selected' : '').'>40 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="45" '.(($_REQUEST['pointsPackage'] == 45) ? 'selected' : '').'>45 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="50" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>50 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="60" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>60 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="70" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>70 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="80" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>80 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="90" '.(($_REQUEST['pointsPackage'] == 50) ? 'selected' : '').'>90 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="100" '.(($_REQUEST['pointsPackage'] == 100) ? 'selected' : '').'>100 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="150" '.(($_REQUEST['pointsPackage'] == 150) ? 'selected' : '').'>150 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="200" '.(($_REQUEST['pointsPackage'] == 200) ? 'selected' : '').'>200 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="250" '.(($_REQUEST['pointsPackage'] == 250) ? 'selected' : '').'>250 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																			<option value="300" '.(($_REQUEST['pointsPackage'] == 300) ? 'selected' : '').'>300 Points '.(($doubleStatus['value'] == "active") ? '(2x)' : '').'</option>
																		</select>
																	</td>
																</tr>										
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
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
					$main_content .= '
						<div class="SubmitButtonRow" >
							<div class="LeftButton" >
								<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
								<input type="hidden" name="step" value="4">
								<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Next" alt="Next" src="'.$layout_name.'/images/global/buttons/_sbutton_next.gif" >
									</div>
								</div>
							</div>
							</form>
							<div class="RightButton" >
								<form method="post" action="?subtopic=accountmanagement&action=donate">
									<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
									<input type="hidden" name="step" value="2">
									<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
											<input class="ButtonText" type="image" name="Previous" alt="Previous" src="'.$layout_name.'/images/global/buttons/_sbutton_previous.gif" >
										</div>
									</div>
								</form>
							</div>
						</div>';
				}
			}
		}
		
		if($step == 4) {

			$donateValue = $_REQUEST['pointsPackage'];
			$donateMethod = $_REQUEST['donateMethod'];
			$donateBank = $_REQUEST['bankname'];
			
			if($donateMethod == "pagseguro") {
				$main_content .= '
					<!-- <form method="post" action="?subtopic=accountmanagement&action=donate"> -->
					    <form target="pagseguro" method="post" action="dntpagseguro.php">
					    <input type="hidden" name="accname" value="'.$account_logged->getName().'">
					    <input type="hidden" name="pid" value="'.$_POST['ServiceID'].'">					    
						<div class="TableContainer" >
							<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Donation Details</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span> 
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td class="LabelV" width="30%">Order</td>
																	<td>'.$config['pagseguro']['offers'][$_POST['ServiceID']].' Premium Points</td>
																</tr>
																<tr>
																	<td class="LabelV" width="30%">Donation Amount</td>
																	<td>R$ '.($_POST['ServiceID'] / 100).',00</td>
																</tr>
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td class="LabelV" width="30%">Donation Method</td>
																	<td>PagSeguro</td>
																</tr>
																<tr>
																	<td class="LabelV">Account Name</td>
																	<td><input type="hidden" value="' . $account_logged->getName() . '" name="account_namev"/>'.$account_logged->getName().'</td>
																</tr>										
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
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
				$main_content .= '
						<div class="SubmitButtonRow" >
							<div class="LeftButton" >
								<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
								<input type="hidden" name="pointsPackage" value="'.$donateValue.'">
								<input type="hidden" name="step" value="5">
								<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Next" alt="Next" src="'.$layout_name.'/images/global/buttons/_sbutton_next.gif" >
									</div>
								</div>
							</div>
							</form>
							<div class="RightButton" >
								<form method="post" action="?subtopic=accountmanagement&action=donate">
									<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
									<input type="hidden" name="pointsPackage" value="'.$donateValue.'">
									<input type="hidden" name="step" value="3">
									<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
											<input class="ButtonText" type="image" name="Previous" alt="Previous" src="'.$layout_name.'/images/global/buttons/_sbutton_previous.gif" >
										</div>
									</div>
								</form>
							</div>
						</div>';
			}
			if($donateMethod == "paypal") {
				$main_content .= '
					<form method="post" action="?subtopic=accountmanagement&action=donate">
						<div class="TableContainer" >
							<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Confirm your order</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span> 
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td class="LabelV" width="30%">Order</td>
																	<td>'.$donateValue.' Premium Points</td>
																</tr>										
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td class="LabelV" width="30%">Donate Method</td>
																	<td>PayPal</td>
																</tr>
																<tr>
																	<td class="LabelV">Account Name</td>
																	<td>'.$account_logged->getName().'</td>
																</tr>										
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
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
				$main_content .= '
						<div class="SubmitButtonRow" >
							<div class="LeftButton" >
								<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
								<input type="hidden" name="pointsPackage" value="'.$donateValue.'">
								<input type="hidden" name="step" value="5">
								<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Next" alt="Next" src="'.$layout_name.'/images/global/buttons/_sbutton_next.gif" >
									</div>
								</div>
							</div>
							</form>
							<div class="RightButton" >
								<form method="post" action="?subtopic=accountmanagement&action=donate">
									<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
									<input type="hidden" name="pointsPackage" value="'.$donateValue.'">
									<input type="hidden" name="step" value="3">
									<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
											<input class="ButtonText" type="image" name="Previous" alt="Previous" src="'.$layout_name.'/images/global/buttons/_sbutton_previous.gif" >
										</div>
									</div>
								</form>
							</div>
						</div>';
			}
			if($donateMethod == "banktransfer") {
				if(!isset($donateBank) || $donateBank == "")
					$donate_errors[] = "You need to select a bank to complete your donation.";
				if(!empty($donate_errors)) {
					$main_content .= '
					<div class="TableContainer" >
						<table class="Table1" cellpadding="0" cellspacing="0" >
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>							
									<div class="Text" >Donate Errors</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer" >
										<table style="width:100%;" >
											<tr>
												<td>';
												foreach($donate_errors as $error)
													$main_content .= $error . '<br>';
											$main_content .= '
												</td>
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
									<form action="?subtopic=accountmanagement&action=donate" method="post">
										<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
										<input type="hidden" name="pointsPackage" value="'.$donateValue.'">
										<input type="hidden" name="step" value="3">
										<tr>
											<td style="border:0px;" ><div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
													<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
														<input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/global/buttons/_sbutton_back.gif" >
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
					<form method="post" action="?subtopic=accountmanagement&action=donate">
						<div class="TableContainer" >
							<table class="Table5" cellpadding="0" cellspacing="0">
							<div class="CaptionContainer" >
								<div class="CaptionInnerContainer" > 
									<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
									<div class="Text" >Confirm your order</div>
									<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span> 
									<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
									<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
									<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span> 
								</div>
							</div>
							<tr>
								<td>
									<div class="InnerTableContainer">
										<table style="width:100%;" >
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td class="LabelV" width="30%">Order</td>
																	<td>'.$donateValue.' Premium Points</td>
																</tr>										
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>
																	<td class="LabelV" width="30%">Donate Method</td>
																	<td>Bank Transfer</td>
																</tr>
																<tr>
																	<td class="LabelV">Account Name</td>
																	<td>'.$account_logged->getName().'</td>
																</tr>										
															</table>
														</div>
													</div>											
													<div class="TableShadowContainer" >
														<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
															<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
															<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
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
				$main_content .= '
						<div class="SubmitButtonRow" >
							<div class="LeftButton" >
								<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
								<input type="hidden" name="pointsPackage" value="'.$donateValue.'">
								<input type="hidden" name="donateBank" value="'.$donateBank.'">
								<input type="hidden" name="step" value="5">
								<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Next" alt="Next" src="'.$layout_name.'/images/global/buttons/_sbutton_next.gif" >
									</div>
								</div>
							</div>
							</form>
							<div class="RightButton" >
								<form method="post" action="?subtopic=accountmanagement&action=donate">
									<input type="hidden" name="donateMethod" value="'.$donateMethod.'">
									<input type="hidden" name="pointsPackage" value="'.$donateValue.'">
									<input type="hidden" name="step" value="3">
									<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
										<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
											<input class="ButtonText" type="image" name="Previous" alt="Previous" src="'.$layout_name.'/images/global/buttons/_sbutton_previous.gif" >
										</div>
									</div>
								</form>
							</div>
						</div>';
				}
			}
		}
		
		if($step == 5) {
			$donateValue = $_REQUEST['pointsPackage'];
			$donateMethod = $_REQUEST['donateMethod'];
			$donateBank = $_REQUEST['donateBank'];
			$donatePrice = $_REQUEST['pointsPackage'] . '.00';
			$donateRef = randString(6);
			$donateDate = time();
			$donateAccount = $account_logged->getName();
			
			if ($doubleStatus['value'] == "active")
				$donatePoints = (2 * $donateValue);
			else
				$donatePoints = $donateValue;
			
			$transRef = $donateRef . '-' . $donateBank;
			
			if( $_SERVER['REQUEST_METHOD']=='POST' ) {
				$hash = md5( implode( $_POST ) );			
				if( isset( $_SESSION['hash'] ) && $_SESSION['hash'] == $hash ) {				
				} else {			
					$_SESSION['hash']  = $request;
					if($donateMethod == "pagseguro")						
						$add_order = $SQL->query("INSERT INTO `z_shop_donates` (`date`,`reference`,`account_name`,`method`,`price`,`coins`,`status`) VALUES ('$donateDate','$donateRef','$donateAccount','$donateMethod','$donatePrice','$donatePoints','waiting')");
					elseif($donateMethod == "paypal")
						$add_order = $SQL->query("INSERT INTO `z_shop_donates` (`date`,`reference`,`account_name`,`method`,`price`,`coins`,`status`) VALUES ('$donateDate','$donateRef','$donateAccount','$donateMethod','$donatePrice','$donatePoints','confirm')");
					else
						$add_order = $SQL->query("INSERT INTO `z_shop_donates` (`date`,`reference`,`account_name`,`method`,`price`,`coins`,`status`) VALUES ('$donateDate','$transRef','$donateAccount','$donateMethod','$donatePrice','$donatePoints','confirm')");
				}
			}
			
			if($donateMethod == "pagseguro") {			

				$main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" > 
										<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
										<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>							
										<div class="Text" >Summary</div>
										<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
										<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
										<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
									</div>
								</div>
								<tr>
									<td>
										<div class="InnerTableContainer" >
											<table style="width:100%;" >
												<tr>
													<td>Your donation is already in our system, to realize your purchase click on "Buy Now" and you will be redirected to the PagSeguro site where you can complete your purchase. Thanks You.</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
							</table>
						</div>';
				$main_content .= '
					<form method="post" action="https://'.(($config['pagseguro']['testing'] === true) ? 'sandbox.' : '').'pagseguro.uol.com.br/v2/checkout/payment.html">
					<div class="SubmitButtonRow" >
						<div class="LeftButton" >
							<input type="hidden" name="receiverEmail" value="'. $config['pagseguro']['email']. '">
							<input type="hidden" name="currency" value="BRL">
							<input type="hidden" name="itemId1" value="1">
							<input type="hidden" name="itemDescription1" value="'.$donatePoints.' Pontos na account de nome: '.$donateAccount.'">
							<input type="hidden" name="itemWeight1" value="0">
							<input type="hidden" name="reference" value="'.$donateRef.'-'.$donateAccount.'">
							<input name="itemAmount1" type="hidden" value="'.$donatePrice.'" size="5" maxlength="5">
							<input name="itemQuantity1" type="hidden" value="1" size="1" maxlength="1">
							<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Buy Now" alt="Buy Now" src="'.$layout_name.'/images/global/buttons/_sbutton_buynow.gif" >
								</div>
							</div>
						</div>
						</form>
						<div class="RightButton" >
							<form method="post" action="?subtopic=accountmanagement&action=manage">
								<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_red.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_red_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Cancel" alt="Cancel" src="'.$layout_name.'/images/global/buttons/_sbutton_cancel.gif" >
									</div>
								</div>
							</form>
						</div>
					</div>';
			} elseif($donateMethod == "paypal") {
				$main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" > 
										<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
										<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>							
										<div class="Text" >Summary</div>
										<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
										<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
										<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
									</div>
								</div>
								<tr>
									<td>
										<div class="InnerTableContainer" >
											<table style="width:100%;" >
												<tr>
													<td>Your donation is already in our system, to realize your purchase click on "Buy Now" and you will be redirected to the Paypal site where you can complete your purchase. Thanks You. Remember that this type of donation requires confirmation.</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
							</table>
						</div>';
				$main_content .= '
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<div class="SubmitButtonRow" >
						<div class="LeftButton" >
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="business" value="'. $config['paypal']['email']. '">
							<input type="hidden" name="item_name" value="' . $donatePoints . ' Tibia Coins">
							<input type="hidden" name="custom" value="'.$refString.'-'.$account_logged->getName().'">
							<input type="hidden" name="amount" value="'.$donatePrice.'">
							<input type="hidden" name="currency_code" value="BRL">
							<input type="hidden" name="no_note" value="0">
							<input type="hidden" name="no_shipping" value="1">
							<input type="hidden" name="rm" value="0">
							<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
								<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
									<input class="ButtonText" type="image" name="Buy Now" alt="Buy Now" src="'.$layout_name.'/images/global/buttons/_sbutton_buynow.gif" >
								</div>
							</div>
						</div>
						</form>
						<div class="RightButton" >
							<form method="post" action="?subtopic=accountmanagement&action=manage">
								<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_red.gif)" >
									<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_red_over.gif);" ></div>
										<input class="ButtonText" type="image" name="Cancel" alt="Cancel" src="'.$layout_name.'/images/global/buttons/_sbutton_cancel.gif" >
									</div>
								</div>
							</form>
						</div>
					</div>';
			} else {
				$main_content .= '
						<div class="TableContainer" >
							<table class="Table1" cellpadding="0" cellspacing="0" >
								<div class="CaptionContainer" >
									<div class="CaptionInnerContainer" > 
										<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
										<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>							
										<div class="Text" >Summary</div>
										<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);" /></span>
										<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);" ></span> 
										<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
										<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);" /></span>
									</div>
								</div>
								<tr>
									<td>
										<div class="InnerTableContainer" >
											<table style="width:100%;" >
												<tr>
													<td>Your donation is already in our system, thanks You. Remember that this type of donation requires confirmation.</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
							</table>
						</div>';
				$main_content .= '
					<TABLE BORDER=0 WIDTH=100%>
						<TR>
							<TD ALIGN=center>
								<table border="0" cellspacing="0" cellpadding="0" >
									<form action="?subtopic=accountmanagement&action=manage" method="post">
										<tr>
											<td style="border:0px;" ><div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton.gif)" >
													<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_over.gif);" ></div>
														<input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/global/buttons/_sbutton_back.gif" >
													</div>
												</div>
											</td>
										</tr>
									</form>
								</table>
							</TD>
						</TR>
					</TABLE>';
			}
		}
}