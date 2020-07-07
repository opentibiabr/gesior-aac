<?php
if (!defined('INITIALIZED'))
	exit;
$main_content .= '
	<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer"> <span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span> <span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
		<div class="Text">Current owner</div> <span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span> <span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span> <span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span> <span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span> </div>
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
											<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
										</div>
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tbody>
														<tr class="LabelH">
															<td width=15% align=center>Outfit</td>
															<td width=25% align=center>Player name</td>
															<td width=10% align=center>Level</td>
															<td width=25% align=center>Guild name</td>
															<td width=10% align=center>Guild level</td>
															<td width=25% align=center>Logo</td>
														</tr>';
$castleHouseId = 2500; // nao sei como chamar pela variavel, entao so vou anotar
$castle = $SQL->query("SELECT * FROM houses WHERE id = 2500")->fetch();
if ($castle['owner'] == 0) {
	$main_content .= '
															<tr>
																<td colspan="4">It looks like the castle stills without an owner.</td>
															</tr>';
} else {
	$main_content .= '
															<tr>
															';
	$player = new Player();
	$player->loadById($castle['owner']);
	$playerName = ($player->isLoaded() ? $player->getName() : "???");
	$main_content .= '
																	<td align=center><img src="' . $player->makeOutfitUrl() . '" width=64 height=64"/></td>
																	<td align=center><a href="?subtopic=characters&name=' . urlencode($playerName) . '">' . $playerName . '</td>
																	<td align=center>' . $player->getLevel() . '</td>
															';
	if (empty($player->getRank())) {
		$main_content .= '
																	<td align=center>none</td>
																	<td align=center>none</td>
																	<td align=center>none</td>
																';
	} else {
		$main_content .= '
																	<td align=center><a href="?subtopic=guilds&action=view&GuildName=' . urlencode($player->getRank()->getGuild()->getName()) . '">' . $player->getRank()->getGuild()->getName() . '</td>
																	<td align=center>' . $player->getRank()->getGuild()->getLevel() . '</td>
																	<td align=center width=65 height=65><img src="' . $player->getRank()->getGuild()->getGuildLogoLink() . '" width=64 height=64></td>
																';
	}
	$main_content .= '
															</tr>
															';
}
$main_content .= '
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
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<br>

<div class="TableContainer">
		<table class="Table3" cellpadding="0" cellspacing="0">
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text" ><center>Castle</center></div>
					<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
				</div>
			</div>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tr>
								<td>
									<div class="TableShadowContainerRightTop"></div>
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tr style="background-color:#D4C0A1">
														<td align="center"><b>Basic Information</b></td>
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
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tr style="background-color:#D4C0A1">
														<td><font size="2"><b>[*]</b> Any player can join the event. You do not need to be inside a guild.</font></td>
													</tr>
													<tr style="background-color:#F1E0C6">
														<td><font size="2"><b>[*]</b> Loot and experience will not be lost by diying inside the arena.</font></td>
													</tr>
													<tr style="background-color:#D4C0A1">
														<td><font size="2"><b>[*]</b> The one that got more points must be <b>online</b> to win.</font></td>
													</tr>
													<tr style="background-color:#F1E0C6">
														<td><font size="2"><b>[*]</b> If no one wins the castle, it will stay without an owner until the next time.</font></td>
													</tr>
													<tr style="background-color:#D4C0A1">
														<td><font size="2"><b>[*]</b> Points can be earned by standing over the red throne.</font></td>
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
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tr style="background-color:#D4C0A1">
														<td align="center"><b>When?</b></td>
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
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tr style="background-color:#F1E0C6">
														<td width="50%" align="center">Todos os dias (every day)</td>
														<td width="50%" align="center">21:00</td>
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
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tr style="background-color:#D4C0A1">
														<td align="center"><b>Rewards</b></td>
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
										<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
											<div class="TableContentContainer">
												<table class="TableContent" width="100%">
													<tr style="background-color:#F1E0C6">
														<td width="100%" align="center">Quelibra Castle (until the next time)</br>15 <a href="?subtopic=eventshop" style="color: red; font-family: georgia;">bars of gold*</a></td>
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
									</div>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</div>';
