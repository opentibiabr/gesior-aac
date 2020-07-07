<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 21/03/2018
 * Time: 19:36
 */

$player_id = $_REQUEST['id'];
if ($player_id) {
	header("Location: ./?subtopic=accountmanagement&action=buychar&id=" . $player_id);
} else {

	$main_content .= "
	<p>Welcome to the character purchase system, here you can buy the character you want using your tibia coins or your balance as payment method.</p>
	<p>Below is the list of characters available for sale on the server, click Buy Character.</p>
	";
	$main_content .= '
<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);"></span>
			<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif);"></span>
			<span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
			<div class="Text">Characters for Sale</div>
			<span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-vertical.gif);"></span>
			<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiacom/images/global/content/table-headline-border.gif)"></span>
			<span class="CaptionEdgeLeftBottom"></span>
			<span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiacom/images/global/content/box-frame-edge.gif);"></span>
		</div>
	</div>
	<table class="Table3" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width: 100%">
							<tbody>
								<tr>';
	$main_content .= '
	<!--
									<td>
										<div class="TableShadowContainerRightTop">
											<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div>
										</div>
										<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tbody>
														<tr style="background-color:#D4C0A1;">
															<td><strong>Filters:</strong></td>
															<td>
																<center><strong><a href="?subtopic=buycharacters">Normal</a></strong></center>
															</td>
															<td>
																<center><strong><a href="?subtopic=buycharacters&amp;filter=price">Price</a></strong></center>
															</td>
															<td>
																<center><strong><a href="?subtopic=buycharacters&amp;filter=level">Level</a></strong></center>
															</td>
															<td>
																<center><strong><a href="?subtopic=buycharacters&amp;filter=sorc">Sorcerers</a></strong></center>
															</td>
															<td>
																<center><strong><a href="?subtopic=buycharacters&amp;filter=druid">Druids</a></strong></center>
															</td>
															<td>
																<center><strong><a href="?subtopic=buycharacters&amp;filter=pala">Paladins</a></strong></center>
															</td>
															<td>
																<center><strong><a href="?subtopic=buycharacters&amp;filter=knight">Knights</a></strong></center>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);">
												<div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);"></div>
												<div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div>
											</div>
										</div>
									</td>
	-->
					';
	$main_content .= '
								</tr>
								<tr>
									<td>
										<div class="TableShadowContainerRightTop">
											<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rt.gif);"></div>
										</div>
										<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tbody>
														<tr style="background-color:#D4C0A1;">
															<td><strong>*</strong></td>
															<td><strong>Character</strong></td>
															<td width="25%" align="center"><strong>Buy</strong></td>
															<td><strong>Value</strong></td>
														</tr>';
	$query = $SQL->prepare("SELECT * FROM account_character_sale WHERE status = 0 AND dta_valid != NOW()");
	$query->execute();
	$playersinsale = $query->fetchAll();
	if ($query->rowCount() > 0) {
		foreach ($playersinsale as $player) {
			$player_sale_info = new Player();
			$player_sale_info->loadById($player['id_player']);
			$player_info = $player_sale_info->data;
			$main_content .= "
<tr>
	";
			$main_content .= "
		  <td><img class='Outfit' src=" . $player_sale_info->makeOutfitUrl() . "' alt='' name=''></td>
		";
			$main_content .= "<td><a href='./?subtopic=characters&name=" . urlencode($player_info['name']) . "'>{$player_info['name']}</a><br/> {$player_sale_info->getVocationName()} - Level {$player_sale_info->getLevel()}</td>
<td>
	<center><a href='?subtopic=accountmanagement&action=buychar&id=" . $player['id_player'] . "' style='padding:0px;margin:0px;'><input name='selectedcharacter' value='' type='hidden'><div class='BigButton' style='background-image:url(./layouts/tibiacom/images/global/buttons/sbutton_green.gif)'><div onmouseover='MouseOverBigButton(this);' onmouseout='MouseOutBigButton(this);'><div class='BigButtonOver' style='background-image: url(./layouts/tibiacom/images/global/buttons/sbutton_green_over.gif&quot;); visibility: visible;'></div><input class='ButtonText' name='Create Character' alt='Create Character' src='./layouts/tibiacom/images/global/buttons/buy_character.gif' type='image'></div></div></a></center>
</td>
	<td>" . ($player['price_type'] == 0 ? number_format($player['price_coins'], 0, ',', '.') . " Coins" : number_format($player['price_gold'], 0, ',', '.') . " Gold Balance") . "</td>
</tr>";
		}
	} else {
		$main_content .= '
			<tr><td colspan="4" style="text-align: center">Não encontramos nenhum player à venda.</td></tr>
		';
	}
	$main_content .= '
													</tbody>
												</table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bm.gif);">
												<div class="TableBottomLeftShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-bl.gif);"></div>
												<div class="TableBottomRightShadow" style="background-image:url(./layouts/tibiacom/images/global/content/table-shadow-br.gif);"></div>
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
</div>
	';

	$main_content .= '
		<p>To put a character of yours on sale just access the menu next to the tab on the option <a href="./?subtopic=accountmanagement&action=sellchar">Sell Characters</a>, remembering that you need to be logged in to your account for this option to appear.</p>
	';
}
