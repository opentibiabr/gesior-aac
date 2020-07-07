<?PHP header("Content-Type: text/html; charset=UTF-8",true);
if(!defined('INITIALIZED'))
	exit;
$main_content .= '<center>
<img width="200px" height="200px" src="./images/vip_logo.png">
			<table>
				<tbody>
					<tr>
						<td><img src="./'.$layout_name.'/images/global/content/headline-bracer-left.gif"></td>
						<td style="text-align:center;vertical-align:middle;horizontal-align:center;font-size:17px;font-weight:bold;">VIP System ' . htmlspecialchars($config['server']['serverName']) . '!</td>
						<td><img src="./'.$layout_name.'/images/global/content/headline-bracer-right.gif"></td>
					</tr>
				</tbody>
			</table>
		</center>

		<br><br>
		<center>  <br />
			<form method="post" action="?subtopic=accountmanagement&action=donate">
				<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
					<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(./'.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
						<input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/global/buttons/_sbutton_gettibiacoins.gif" >
					</div>
				</div>
			</form>

	</center>

	<br><br>

		<h3>Find out what are the advantages and benefits of being a VIP below:</h3>
		<br>
		<li>Get VIP and help the <b>' . $config["server"]["serverName"] . '</b> grow even more!</li>
		<br>
		<div class="TableContainer">
				<div class="CaptionContainer">
						<div class="CaptionInnerContainer">
								<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>        <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>        <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>        <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
								<div class="Text">VIP System Information</div>
								<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>        <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/global/content/table-headline-border.gif);"></span>        <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>        <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
						</div>
				</div>
				<table class="Table3" cellpadding="0" cellspacing="0">
						<tbody>
						<tr>
								<td>
										<div class="InnerTableContainer">
												<table style="width:100%;">
														<tbody>
														 <tr>
																<td>
																		<div class="TableShadowContainerRightTop">
																				<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);"></div>
																		</div>
																		<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);">
																				<div class="TableContentContainer">
																						<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																								<tbody>
																								<tr class="LabelH">
														<td width="25%">Benefit</td>
																										<td width="25%"><center>VIP Details </center></td>
																										<td width="25%"><center>Free</center></td>
																										<td width="25%"><center>VIP</center></td>
																								</tr>
																								<tr class="Odd">
																										<td><b>XP Boost</b></td>
													<td align="center" valign="middle">
													<span>
														<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'10% XP boost for your hunt.\', \'<p>How about gaining 10% more XP when hunting? As a VIP player, you can enjoy this valuable boost.</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
														<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-Stamina.png" />
														</span>
													</span>

													</td>

																										<td align="center">
<img src="./images/premiumfeatures/icon_no.png"></td>
																										<td align="center">
<img src="./images/premiumfeatures/icon_yes.png"></td>

																								</tr>
																								<tr class="Odd">
																										<td><b>Store discount</b></td>
													<td align="center" valign="middle">
													<span>
														<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'10% off in Store.\', \'<p>VIP players have a 10% discount on the purchase of any product in the Store.</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
														<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-Market.png" />
														</span>
													</span>

													</td>

																										<td align="center">
<img src="./images/premiumfeatures/icon_no.png"></td>
																										<td align="center">
<img src="./images/premiumfeatures/icon_yes.png"></td>

																								</tr>
																						<tr class="Odd">
																										<td><b>Refined quick looting</b></td>
													<td align="center" valign="middle">
													<span>
														<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Customise quick looting to your liking\', \'<p>Refine the Loot All option by excluding items or set up a list to only loot specific items. Premium status also allows you to loot a single item with a simple click and to assign categories to your containers to automatically sort looted items.</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
														<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-QuickLoot.png" />
														</span>
													</span>

													</td>
															<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
															<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
													</tr>
												<tr class="Odd" style="background-color:#D4C0A1">
																										<td><b>Slots AutoLoot</b></td>
													<td align="center" valign="middle">
											 <span>
														<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'More space on the autoloot.\', \'<p>VIP players have more slots for their item list (client 10)</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
														<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-QuickLoot.png" />
														</span>
													</span>

													</td>

																										<td align="center">10 Slots</td>
																										<td align="center">25 Slots</td>

																								</tr>

												<tr class="Odd">
																										<td><b>Loot Boost</b></td>
													<td align="center" valign="middle">
											 <span>
														<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'A better loot rate\', \'<p>Improved chance of obtaining better loots in your hunt</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
														<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-TrackLoot.png" />
														</span>
													</span>

													</td>

																										<td align="center">
<img src="./images/premiumfeatures/icon_no.png"></td>
																										<td align="center">
<img src="./images/premiumfeatures/icon_yes.png"></td>

																								</tr>

												<tr class="Odd" style="background-color:#D4C0A1">
																										<td ><b>Exclusive outfit addons</b></td>
													<td align="center" valign="middle">
													 <span>
														<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Exclusive Outfits!\', \'<p>Because basic outfits alone are not dashing enough! Earn addons to make your character stand out and prove your skill as an adventurer.</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
														<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-Addons.png" />
														</span>
													</span>

													</td>

																										<td align="center">0</td>
																										<td align="center">+3</td>

																								</tr>
												<tr class="Odd">
																										<td ><b>Exclusive Mounts</b></td>
													<td align="center" valign="middle">
													<span>
														<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Tame mounts to travel faster\', \'<p>Tame majestic wild creatures and get yourself faithful travel companions. They will carry you swiftly to your destination. Impress others by riding into battle on rare mounts!</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
														<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-Mount.png" />
														</span>
													</span>

													</td>

																										<td align="center">0</td>
																										<td align="center">+3</td>

																								</tr>

																						<tr class="Odd">
																										<td><b>Use the permanent teleport scroll</b></td>
													<td align="center" valign="middle">
													<span>
														<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Temple Scroll\', \'<p>With it, you can go to your home or some city temple.</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
														<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-NewAreas.png" />
														</span>
													</span>

													</td>
															<td align="center"><img src="./images/premiumfeatures/icon_no.png"></td>
															<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
													</tr>

<tr class="Odd">
	<td><b>Chat by PM with Administrators</b></td>
<td align="center" valign="middle">
<span>
	<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Chat with Administrators\', \'<p>Any player can chat with the administrator, there is no distinction.</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
	<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-Chat.png" />
	</span>
</span>
</td>
		<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
		<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
</tr>

<tr class="Odd">
	<td><b>Access to all quests</b></td>
<td align="center" valign="middle">
<span>
	<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Solve exclusive quests for the best rewards\', \'<p>Unravel mysteries and face evil masterminds as you solve the abundance of thrilling quests Tibia has to offer. Get your hands on the most precious rewards and rare treasures!</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
	<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-Quests.png" />
	</span>
</span>
</td>
		<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
		<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
</tr>

<tr class="Odd">
	<td><b>Access to Premium Plaza</b></td>
<td align="center" valign="middle">
<span>
	<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'House ownership\', \'<p>Enjoy the exclusive ability to rent a house where you can regenerate and also train your skills while sleeping in your bed. Make yourself at home and choose from the vast assortment of furniture and decorations, put your treasures on display, and invite your friends over.</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
	<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-NewAreas.png" />
	</span>
</span>
</td>
		<td align="center"><img src="./images/premiumfeatures/icon_no.png"></td>
		<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
</tr>

<tr class="Odd">
	<td><b>GB system (guild bank)</b></td>
<td align="center" valign="middle">
<span>
	<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'GB system\', \'<p>Deposits, withdrawals and point transactions between guilds</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
	<image style="border:0px;" src="./images/premiumfeatures/PremiumIcon-Guild.png" />
	</span>
</span>
</td>
		<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
		<td align="center"><img src="./images/premiumfeatures/icon_yes.png"></td>
</tr>

																								</tbody>
																						</table>
																				</div>
																		</div>
																		<div class="TableShadowContainer">
																				<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);">
																						<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
																						<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>
																				</div>
																		</div>
																</td>
														</tr>
														</tbody>
												</table>
										</div>
								</td>
						</tr>
						</tbody>
				</table>
		</div><br><br>';

	$main_content .= '
	<div class="TableContainer">
		<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url(./'.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url(./'.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionBorderTop" style="background-image:url(./'.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionVerticalLeft" style="background-image:url(./'.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text">Exclusive outfit addons and mounts</div>
					<span class="CaptionVerticalRight" style="background-image:url(./'.$layout_name.'/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url(./'.$layout_name.'/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(./'.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(./'.$layout_name.'/images/global/content/box-frame-edge.gif);"></span>
				</div>
			</div><table class="Table3" cellpadding="0" cellspacing="0">

			<tbody><tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tbody><tr>
								<td>
									<div class="TableShadowContainerRightTop"></div>
										<div class="TableContentAndRightShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tbody><tr style="background-color:#D4C0A1">
														<td align="center"><b>Exclusive outfit addons:</b></td>
													</tr>
												</tbody></table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-bm.gif);">
												<div class="TableBottomLeftShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
												<div class="TableBottomRightShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>
											</div>
										</div>

								</td>
							</tr>
						</tbody></table>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tbody><tr>
								<td>
									<div class="TableShadowContainerRightTop"></div>
										<div class="TableContentAndRightShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tbody><tr style="background-color:#F1E0C6">
														<td width="33%" align="center"><img src="https://www.tibiawiki.com.br/images/9/9a/Outfit_Void_Master_Male_Addon_3.gif"></td>
														<td width="33%" align="center"><img src="https://www.tibiawiki.com.br/images/1/19/Outfit_Veteran_Paladin_Male_Addon_3.gif"></td>
														<td width="33%" align="center"><img src="https://www.tibiawiki.com.br/images/4/43/Outfit_Lion_of_War_Male_Addon_3.gif"></td>
													</tr>
												</tbody></table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-bm.gif);">
												<div class="TableBottomLeftShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
												<div class="TableBottomRightShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>
											</div>
										</div>

								</td>
							</tr>
						</tbody></table>
					</div>
				</td>
			</tr>


			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tbody><tr>
								<td>
									<div class="TableShadowContainerRightTop"></div>
										<div class="TableContentAndRightShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tbody><tr style="background-color:#D4C0A1">
														<td align="center"><b>Exclusive mounts:</b></td>
													</tr>
												</tbody></table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-bm.gif);">
												<div class="TableBottomLeftShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
												<div class="TableBottomRightShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>
											</div>
										</div>

								</td>
							</tr>
						</tbody></table>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tbody><tr>
								<td>
									<div class="TableShadowContainerRightTop"></div>
										<div class="TableContentAndRightShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tbody><tr style="background-color:#F1E0C6">
														<td width="33%" align="center"><img src="https://www.tibiawiki.com.br/images/d/d4/Blazing_Unicorn.gif"></td>
														<td width="33%" align="center"><img src="https://www.tibiawiki.com.br/images/b/ba/Arctic_Unicorn.gif"></td>
														<td width="33%" align="center"><img src="https://www.tibiawiki.com.br/images/c/c7/Prismatic_Unicorn.gif"></td>
													</tr>
												</tbody></table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-bm.gif);">
												<div class="TableBottomLeftShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-bl.gif);"></div>
												<div class="TableBottomRightShadow" style="background-image:url(./'.$layout_name.'/images/global/content/table-shadow-br.gif);"></div>
											</div>
										</div>

								</td>
							</tr>
						</tbody></table>
					</div>
				</td>
			</tr>

		</tbody></table>
	</div>

		<br><br>';

 $main_content .= '
	<h2>Pricing</h2><p style="margin-top: 20px; margin-bottom: 20px;">Best of all, Tibia VIP Time is inexpensive! You can upgrade your account to VIP starting from as little as 250 TC for a month:</p><div class="TableContainer"> <table class="Table3" cellpadding="0" cellspacing="0"> <div class="CaptionContainer"> <div class="CaptionInnerContainer"> <span class="CaptionEdgeLeftTop" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-edge.gif);" /></span> <span class="CaptionEdgeRightTop" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-edge.gif);" /></span> <span class="CaptionBorderTop" style="background-image:url(./'. $layout_name .'/images/global/content/table-headline-border.gif);"></span> <span class="CaptionVerticalLeft" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-vertical.gif);" /></span> <div class="Text">VIP Time</div> <span class="CaptionVerticalRight" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-vertical.gif);" /></span> <span class="CaptionBorderBottom" style="background-image:url(./'. $layout_name .'/images/global/content/table-headline-border.gif);"></span> <span class="CaptionEdgeLeftBottom" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-edge.gif);" /></span> <span class="CaptionEdgeRightBottom" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-edge.gif);" /></span> </div> </div> <tr> <td> <div class="InnerTableContainer"> <table style="width:100%;"><tr><td><div class="TableShadowContainerRightTop"> <div class="TableShadowRightTop" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-rt.gif);"></div></div><div class="TableContentAndRightShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-rm.gif);"> <div class="TableContentContainer"> <table class="TableContent" width="100%" style="border:1px solid #faf0d7;"><tr><td colspan="3">VIP Time can only be used for your own account, while the scroll can be sold.</td></tr> </table> </div></div><div class="TableShadowContainer"> <div class="TableBottomShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-bm.gif);"> <div class="TableBottomLeftShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-bl.gif);"></div> <div class="TableBottomRightShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-br.gif);"></div> </div></div></td></tr><tr><td><div class="TableShadowContainerRightTop"> <div class="TableShadowRightTop" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-rt.gif);"></div></div><div class="TableContentAndRightShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-rm.gif);"> <div class="TableContentContainer"> <table class="TableContent" width="100%" style="border:1px solid #faf0d7;"><tr class="LabelV"><td style="width: 25%;">Duration</td><td style="width: 25%;">Price</td></tr>
	<tr class="Odd"><td>1 month (30 days)</td><td>Tibia Coins 250</td></tr>
	<tr class="Even"><td>3 months (90 days)</td><td>Tibia Coins 400</td></tr>
	<tr class="Odd"><td>6 months (180 days)</td><td>Tibia Coins 700</td></tr>
	<tr class="Even"><td>12 months (360 days)</td><td>Tibia Coins 1000</td></tr>

	</table> </div></div>
<div class="TableShadowContainer"> <div class="TableBottomShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-bm.gif);"> <div class="TableBottomLeftShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-bl.gif);"></div> <div class="TableBottomRightShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-br.gif);"></div> </div></div></td></tr> </table> </div> </td> </tr> </table></div><p style="margin-top: 20px; margin-bottom: 20px;">And that\'s not all, you can also buy <b><font color=green>VIP</font></b> for Tibia Coins in the game Store! Since Tibia Coins can also be sold on the Market for golds, you can buy them and buy VIP or an extra service for your account, even if you are unable to pay with real money or Tibia Coins at the moment. There is really no excuse for not becoming a VIP account - buy VIP Time or Tibia Coins and enjoy the full Tibia experience today!</p>
	';


$main_content .= '
<div class="TableContainer"> <table class="Table3" cellpadding="0" cellspacing="0"> <div class="CaptionContainer"> <div class="CaptionInnerContainer"> <span class="CaptionEdgeLeftTop" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-edge.gif);" /></span> <span class="CaptionEdgeRightTop" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-edge.gif);" /></span> <span class="CaptionBorderTop" style="background-image:url(./'. $layout_name .'/images/global/content/table-headline-border.gif);"></span> <span class="CaptionVerticalLeft" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-vertical.gif);" /></span> <div class="Text">Tibia Coin Packages</div> <span class="CaptionVerticalRight" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-vertical.gif);" /></span> <span class="CaptionBorderBottom" style="background-image:url(./'. $layout_name .'/images/global/content/table-headline-border.gif);"></span> <span class="CaptionEdgeLeftBottom" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-edge.gif);" /></span> <span class="CaptionEdgeRightBottom" style="background-image:url(./'. $layout_name .'/images/global/content/box-frame-edge.gif);" /></span> </div> </div> <tr> <td> <div class="InnerTableContainer"> <table style="width:100%;"><tr><td><div class="TableShadowContainerRightTop"> <div class="TableShadowRightTop" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-rt.gif);"></div></div><div class="TableContentAndRightShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-rm.gif);"> <div class="TableContentContainer"> <table class="TableContent" width="100%" style="border:1px solid #faf0d7;"><tr><td colspan="3">Tibia Coins can be used to purchase Premium Time or special products for your own account in the Store, or if transferable, traded via the Market or gifted to other characters.</td></tr> </table> </div></div><div class="TableShadowContainer"> <div class="TableBottomShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-bm.gif);"> <div class="TableBottomLeftShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-bl.gif);"></div> <div class="TableBottomRightShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-br.gif);"></div> </div></div></td></tr><tr><td><div class="TableShadowContainerRightTop"> <div class="TableShadowRightTop" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-rt.gif);"></div></div><div class="TableContentAndRightShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-rm.gif);"> <div class="TableContentContainer"> <table class="TableContent" width="100%" style="border:1px solid #faf0d7;"><tr class="LabelV"><td style="width: 25%;">Package</td><td style="width: 25%;">Price</td><td></td></tr>

	<tr class="Even"><td>50 Tibia Coins</td><td>BRA 5,00</td><td></td></tr>
	<tr class="Odd"><td>100 Tibia Coins</td><td>BRA 10,00</td><td></td></tr>
	<tr class="Even"><td>250 Tibia Coins</td><td>BRA 25,00</td><td>(price for 30 days Premium Time in the Store)</td></tr>
	<tr class="Odd"><td>500 Tibia Coins</td><td>BRA 45,00</td><td>(price for 90 days Premium Time in the Store and 100 Tibia Coins left)</td></tr>
	<tr class="Even"><td>1000 Tibia Coins</td><td>BRA 90,00</td><td>(price for 360 days Premium Time in the Store)</td></tr>
	<tr class="Odd"><td>2000 Tibia Coins</td><td>BRA 160,00</td><td></td></tr>
	<tr class="Even"><td>3000 Tibia Coins</td><td>BRA 240,00</td><td></td></tr>
	<tr class="Odd"><td>4000 Tibia Coins</td><td>BRA 280,00</td><td></td></tr>

	 </table> </div></div><div class="TableShadowContainer"> <div class="TableBottomShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-bm.gif);"> <div class="TableBottomLeftShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-bl.gif);"></div> <div class="TableBottomRightShadow" style="background-image:url(./'. $layout_name .'/images/global/content/table-shadow-br.gif);"></div> </div></div></td></tr> </table> </div> </td> </tr> </table></div>
';

		$main_content .= '<center>  <br />
	<form method="post" action="?subtopic=accountmanagement&action=donate">
				<div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_green.gif)" >
					<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url(./'.$layout_name.'/images/global/buttons/sbutton_green_over.gif);" ></div>
						<input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/global/buttons/_sbutton_gettibiacoins.gif" >
					</div>
				</div>
			</form>

	</center>

	<br><br>
	';
