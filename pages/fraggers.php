<?php
if (!defined('INITIALIZED')) {
	exit;
}
$main_content .= '
<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
			<div class="Text">Top 3 Killers</div>
			<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
			<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
			<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
		</div>
	</div>
	<table class="Table5" cellpadding="0" cellspacing="0">
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
												<table border="0" cellpadding="4" cellspacing="1" class="TableContent" width="100%"">
										<tbody>

										 <tr bgcolor="' . $config['site']['darkborder'] . '">
												<td align="center" colspan="3"><b>Ranking top 3# Killers</b></td>
										</tr>
										<tr bgcolor="' . $config['site']['lightborder'] . '">';
$topfrags = $SQL->query('SELECT `killed_by` as `name`, COUNT(`killed_by`) AS `frags` FROM `player_deaths` WHERE `is_player` = 1 GROUP BY `killed_by` ORDER BY COUNT(`killed_by`) DESC LIMIT 3;')->fetchAll();
if (count($topfrags) > 0) {
	$i = 0;
	foreach ($topfrags as $topf) {
		$i++;
		$tplayer = new Player();
		$tplayer->loadByName($topf['name']);
		$main_content .= '
											<td align="center" width="33%">
												<div style="position: relative; width: 32px; height: 32px;">
													<img style="z-index: 10; margin-top: -13px; margin-left: -85px; position: relative;" src="images/events/topfraggers/' . $i . '.gif">
													<div style="background-image: url(' . $tplayer->makeOutfitUrl() . '); position: absolute; width: 64px; height: 80px; background-position: bottom right; background-repeat: no-repeat; right: -5px; bottom: -15px;">
													</div>
												</div>
												<br>
												<a class="topfragctext" href="?subtopic=characters&name=' . urlencode($topf['name']) . '"> ' . htmlspecialchars($topf['name']) . '</a>
												<br>
												<b id="topfragcolocacao">#' . $i . '</b> <b style="font-size: 0.8em;">(Frags: ' . $topf['frags'] . ')</b>
											</td> ';
	}
} else {
	$main_content .= '
											<td align="center" width="33%"> Nenhuma morte registrada.</td>';
}
$main_content .= '
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
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<br>';
$main_content .= '
<div class="TableContainer">
	 <table class="Table3" cellpadding="0" cellspacing="0">
		  <div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					 <span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					 <span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					 <span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					 <span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
					 <div class="Text">Top Fraggers</div>
					 <span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
					 <span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					 <span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					 <span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
				</div>
		  </div>
		  <tr>
				<td>
					 <div class="InnerTableContainer">
						  <table style="width:100%;">
								<tr>
									 <td>

										  <div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
												<div class="TableContentContainer">
													 <table class="TableContent" width="100%">
											<tr>';
$main_content .= '
											</tr>
														  <tr>
																<table class="Table1" cellpadding="0" cellspacing="0">
																	 <td style="text-align: center; font-weight: bold;">#</td>
																	 <td style="text-align: center; font-weight: bold;">Name</td>
																	 <td style="text-align: center; font-weight: bold;">Frags</td>
											</tr>';
$query = $SQL->query('SELECT `killed_by` as `name`, COUNT(`killed_by`) AS `frags` FROM `player_deaths` WHERE `is_player` = 1 GROUP BY `killed_by` ORDER BY COUNT(`killed_by`) DESC LIMIT 0, 30;');
$i = 0;
foreach ($query as $player) {
	$i++;
	$nplayer = new Player();
	$nplayer->loadByName($player['name']);
	$main_content .= '
														  <tr bgcolor="' . (is_int($i / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']) . '">
																<td style="text-align: center;"><img src="' . $nplayer->makeOutfitUrl() . '"></td>
																<td style="text-align: center;"><a href="?subtopic=characters&name=' . urlencode($player['name']) . '">' . htmlspecialchars($player['name']) . '</a></td>
																<td style="text-align: center;">' . $player['frags'] . '</td>
														  </tr>
											</tr>';
}
$main_content .= '
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
</br>';
