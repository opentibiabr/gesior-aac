<?php
if (!defined('INITIALIZED'))
	exit;
$main_content .= "
<script type=\"text/javascript\">
	function show_hide(flip)
	{
			var tmp = document.getElementById(flip);
			if(tmp)
					tmp.style.display = tmp.style.display == 'none' ? '' : 'none';
	}
</script>
<style type=\"text/css\">
#guildWar2 {
	width: 64px;
	height: 64px;
	position: relative
}

#guildWarLogo2 {
	position: absolute;
	left: 0;
	top: 0
}

#guildWarOverlay30 {
	z-index: 100;
	position: absolute;
	font-size: 30px;
	color: white;
	font-weight: 700;
	margin-top: 10px;
	margin-bottom: 0;
	margin-left: -3px;
	margin-right: 0;
	height: 32px;
	width: 64px;
	text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000
}
</style>";
$main_content .= '
<div class="TableContainer" style="position:relative;">
			<div class="CaptionContainer">
				<div class="CaptionInnerContainer">
					<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<div class="Text">About</div>
					<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
					<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span>
					<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
					<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
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
										<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);"></div>
									</div>
									   <div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
										<div class="TableContentContainer">
											<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
														<tr>
															<td width=50% align=center>!war invite <b>guild_name, fraglimit</b></td>
															<td width=50% align=center>Invite guild to war</td>
														</tr>
														<tr>
															<td width=50% align=center>!war <b>accept, guild_name</b></td>
															<td width=50% align=center>Accept invitation to war</td>
														</tr>
														<tr>
															<td width=50% align=center>!war <b>reject, guild_name</b></td>
															<td width=50% align=center>Reject invitation</td>
														</tr>
														<tr>
															<td width=50% align=center>!war <b>cancel, guild_name</b></td>
															<td width=50% align=center>Cancel invitation</td>
														</tr>
														<tr>
															<td width=50% align=center>!war <b>stop, guild_name</b></td>
															<td width=50% align=center>Stop active war (only loosing guild can use this command)</td>
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
<br>

<div class="TableContainer" >
			<table class="Table3" cellpadding="0" cellspacing="0" >
				<div class="CaptionContainer" >
					<div class="CaptionInnerContainer" >
						<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
						<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
						<div class="Text" >Guild Wars</div>
						<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);" /></span>
						<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);" ></span>
						<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
						<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);" /></span>
					</div>
				</div>
				<tr>
					<td>
						<div class="InnerTableContainer" >
							<table style="width:100%;" >';
$main_content .= '
								<tr>
									<td>
										<div class="TableShadowContainerRightTop" >
												<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
											</div>
											<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
												<div class="TableContentContainer" >
													<table class="TableContent" width="100%" >
														<tr class="LabelV">
															<td>Aggressor</td>
															<td>Information</td>
															<td>Enemy</td>
														</tr>';
$warFrags = array();
foreach ($SQL->query('SELECT * FROM `guildwar_kills` ORDER BY `time` DESC')->fetchAll() as $frag) {
	$warFrags[$frag['warid']][] = $frag;
}

$count = 0;
foreach ($SQL->query('SELECT `guild_wars`.`id`, `guild_wars`.`guild1`, `guild_wars`.`guild2`, `guild_wars`.`name1`, `guild_wars`.`name2`, `guild_wars`.`status`, `guild_wars`.`started`, `guild_wars`.`ended`, `guild_wars`.`frags_limit`, (SELECT COUNT(1) FROM `guildwar_kills` WHERE `guildwar_kills`.`warid` = `guild_wars`.`id` AND `guildwar_kills`.`killerguild` = `guild_wars`.`guild1`) guild1_kills, (SELECT COUNT(1) FROM `guildwar_kills` WHERE `guildwar_kills`.`warid` = `guild_wars`.`id` AND `guildwar_kills`.`killerguild` = `guild_wars`.`guild2`) guild2_kills FROM `guild_wars` ORDER BY `started` DESC') as $war) {
	$count++;
	$main_content .= "<tr style=\"background: " . (is_int($count / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']) . ";\">
														<td align=\"center\"><a href=\"?subtopic=guilds&action=view&GuildName=" . $war['name1'] . "\">
														<div id=\"guildWar2\">
														<img id=\"guildWarLogo2\" src=\"guild_image.php?id=" . $war['guild1'] . "\" width=\"64\" height=\"64\" border=\"0\"/>
														<p id=\"guildWarOverlay30\">" . $war['guild1_kills'] . "</p>
														</div>
														<br />
														" . htmlspecialchars($war['name1']) . "</a></td>
														<td align=\"center\">";
	switch ($war['status']) {
		case 0: {
				$main_content .= "<b>Pending acceptation</b><br />Invited on " . date("M d Y, H:i:s", $war['started']) . " for 2 hours war.<br />";
				if ($guild_leader && $war['guild2'] == $guild->getID()) {
					$main_content .= '<br /><a href="?subtopic=guilds&action=guildwar_accept&GuildName=' . $guild_name . '&war=' . $war['id'] . '" onclick="return confirm(\'Are you sure that you want ACCEPT that invitation for 2 hours war?\');" style="cursor: pointer;">accept invitation to war</a>';
					$main_content .= '<br /><br /><a href="?subtopic=guilds&action=guildwar_reject&GuildName=' . $guild_name . '&war=' . $war['id'] . '" onclick="return confirm(\'Are you sure that you want REJECT that invitation for 2 hours war?\');" style="cursor: pointer;">reject invitation to war</a>';
				}
				if ($guild_leader && $war['guild1'] == $guild->getID()) {
					$main_content .= '<br /><br /><a href="?subtopic=guilds&action=guildwar_cancel&GuildName=' . $guild_name . '&war=' . $war['id'] . '" onclick="return confirm(\'Are you sure that you want CANCEL that invitation for 2 hours war?\');" style="cursor: pointer;">cancel invitation to war</a>';
				}
				$main_content .= '</font>';
				break;
			}
		case 1: {
				$main_content .= "<font size=\"12\"><span style=\"color: red;\">" . $war['guild1_kills'] . "</span><font color=black> : </font><span style=\"color: blue;\">" . $war['guild2_kills'] . "</span></font><br /><br /><span style=\"color: darkred; font-weight: bold;\">On a brutal war</span><br /><font color=black>Began on " . date("M d Y, H:i:s", $war['started']) . ", will end up after server restart after " . date("M d Y, H:i:s", $war['started'] + (2 * 3600)) . ".<br /></font>";
				$main_content .= "<br /><br />";
				if (in_array($war['status'], array(1, 4))) {
					$main_content .= "<a onclick=\"show_hide('war-details:" . $war['id'] . "'); return false;\" style=\"cursor: pointer;\">War Details</a>";
				}
				break;
			}
		case 2: {
				$main_content .= "<b>Rejected invitation</b><br />Invited on " . date("M d Y, H:i:s", $war['started']) . ", rejected on " . date("M d Y, H:i:s", $war['ended']) . ".</font>";
				break;
			}
		case 3: {
				$main_content .= "<b>Canceled invitation</b><br />Sent invite on " . date("M d Y, H:i:s", $war['started']) . ", canceled on " . date("M d Y, H:i:s", $war['ended']) . ".</font>";
				break;
			}
		case 4: {
				$main_content .= "<b><span style=\"font-size: 18px; color: brown;\">" . $war['guild1_kills'] . " : " . $war['guild2_kills'] . "</span></br>Ended</b><br />Began on " . date("M d Y, H:i:s", $war['started']) . "</br>Ended on " . date("M d Y, H:i:s", $war['ended']) . ".</br><b>Frag limit: " . $war['frags_limit'] . "</b>";
				$main_content .= "<br /><br />";
				if (in_array($war['status'], array(1, 4))) {
					$main_content .= "<a onclick=\"show_hide('war-details:" . $war['id'] . "'); return false;\" style=\"cursor: pointer;\">&raquo; Details &laquo;</a>";
				}
				$main_content .= "</font>";
				break;
			}
		default: {
				$main_content .= "Unknown, please contact with gamemaster.";
				break;
			}
	}
	$main_content .= "</td>
														<td align=\"center\"><a href=\"?subtopic=guilds&action=view&GuildName=" . $war['name2'] . "\">
														<div id=\"guildWar2\">
														<img id=\"guildWarLogo2\" src=\"guild_image.php?id=" . $war['guild2'] . "\" width=\"64\" height=\"64\" border=\"0\"/>
														<p id=\"guildWarOverlay30\">" . $war['guild2_kills'] . "</p>
														</div>
														<br/>
														" . htmlspecialchars($war['name2']) . "</a></td>
														</tr>
														<tr id=\"war-details:" . $war['id'] . "\" style=\"display: none; background: " . (is_int($count / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']) . ";\">
														<td colspan=\"3\">";
	if (in_array($war['status'], array(1, 4))) {
		if (isset($warFrags[$war['id']])) {
			foreach ($warFrags[$war['id']] as $frag) {
				$bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
				$main_content .= '
																		<div class="InnerTableContainer" >
																		<table style="width:100%;" >
																		<tr>
																		<td><div class="TableShadowContainerRightTop" >
																		<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);" ></div>
																		</div>
																		<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);" >
																		<div class="TableContentContainer" >
																		<table class="TableContent" width="100%" >
																		<tr>
																		<table align="center" border="0" cellspacing="1" cellpadding="4" width="100%">
																		<tr width="100%" bgcolor="' . $bgcolor . '">
																		<td width="30%" align="left">';
				$main_content .= date("j M Y, H:i", $frag['time']) . " </td>
																		<td width=\"30%\" align=\"center\"><span style=\"color: " . ($frag['killerguild'] == $war['guild1'] ? $point = $war['name1'] : $point = $war['name2']) . ";\">" . $point . " [+1]</td>
																		<td width=\"40%\" align=\"right\"></span><a href=\"?subtopic=characters&name=" . urlencode($frag['killer']) . "\"><b>" . htmlspecialchars($frag['killer']) . "</b></a> killed <a href=\"?subtopic=characters&name=" . urlencode($frag['target']) . "\"> " . htmlspecialchars($frag['target']) . "</a></td>
																		</tr>
																		</table>
																		</tr>
																		</table>
																		</div>
																		</div>
																		";
			}
		} else
			$main_content .= "<center>There were no frags on this war so far.</center>";
	} else
		$main_content .= "</td></tr>";
}
$main_content .= '
													</table>
												</div>
											</div>
										</div>
									</td>
								</tr>';
if ($count == 0)
	$main_content .= "
								<tr>
									<td>The guild " . $guild_name . " is currently not involved in a guild war.</td>
								</tr>";
$main_content .= '
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<br/>
';
